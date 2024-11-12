# Import necessary libraries
from sklearn.tree import DecisionTreeClassifier
from sklearn.model_selection import train_test_split, cross_val_score
from sklearn.metrics import accuracy_score, classification_report, confusion_matrix
import pandas as pd
import matplotlib.pyplot as plt
from sklearn import tree
import seaborn as sns
import numpy as np
import json
import sys

def main():
    # Load dataset
    data = pd.read_csv('gwa_income_eligibility_dataset.csv')

    # Apply noise to 'GWA' and 'Income'
    noise_gwa = np.random.normal(0, 2, data.shape[0])  # Reduced noise in GWA
    noise_income = np.random.normal(0, 2000, data.shape[0])  # Reduced noise in Income

    # Add noise to columns
    data['GWA'] = data['GWA'] + noise_gwa
    data['Income'] = data['Income'] + noise_income

    # Clip values to maintain valid ranges
    data['GWA'] = data['GWA'].clip(60, 100)  # Ensure GWA stays between 60-100
    data['Income'] = data['Income'].clip(1000, 50000)  # Ensure income stays between 1000-50000

    # Define features (remove 'Name' and 'Eligible') and target ('Eligible')
    X = data.drop(['Name', 'Eligible'], axis=1)
    y = data['Eligible']  # Use 'Eligible' as the target

    # Split the dataset
    X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

    # Initialize the Decision Tree model with higher depth and relaxed regularization
    model = DecisionTreeClassifier(
        criterion='gini',
        class_weight='balanced',
        max_depth=10,  # Increased depth to capture more complex patterns
        min_samples_split=10,  # Reduced minimum samples split for more branching
        min_samples_leaf=4,  # Reduced leaf size to allow better fitting
        random_state=42
    )

    # Fit the model
    model.fit(X_train, y_train)

    # Make predictions
    y_pred = model.predict(X_test)

    # Evaluate the model
    accuracy = accuracy_score(y_test, y_pred)
    print("Decision Tree Model Accuracy with Noise:", accuracy)

    # Detailed classification report
    print("\nClassification Report for Decision Tree with Noise:")
    print(classification_report(y_test, y_pred))

    # Confusion matrix for Decision Tree
    conf_matrix = confusion_matrix(y_test, y_pred)
    plt.figure(figsize=(8, 6))
    sns.heatmap(conf_matrix, annot=True, fmt='d', cmap='Blues', xticklabels=['Not Eligible', 'Eligible'], yticklabels=['Not Eligible', 'Eligible'])
    plt.xlabel('Predicted')
    plt.ylabel('Actual')
    plt.title('Confusion Matrix for Decision Tree with Noise')
    plt.show()

    # Cross-validation accuracy for Decision Tree
    cv_scores = cross_val_score(model, X, y, cv=10)
    print("\nCross-Validation Mean Accuracy for Decision Tree with Noise:", np.mean(cv_scores))

    # Visualize the decision tree
    plt.figure(figsize=(20, 10))
    tree.plot_tree(model, feature_names=X.columns, class_names=["Not Eligible", "Eligible"], filled=True)
    plt.title('Visualized Decision Tree with Noise')
    plt.show()

    # Prepare predictions for export as JSON
    predictions = []
    for i in range(len(y_pred)):
        predictions.append({
            "Name": data.iloc[i]['Name'],  # Assuming the 'Name' column exists
            "GWA": data.iloc[i]['GWA'],
            "Income": data.iloc[i]['Income'],
            "Eligible": 'Eligible' if y_pred[i] == 1 else 'Not Eligible'
        })

    # Export the predictions to a JSON file
    with open('predictions_output.json', 'w') as json_file:
        json.dump(predictions, json_file, indent=4)

    print("Predictions have been exported to 'predictions_output.json'.")

if __name__ == '__main__':
    # Check if the script is being run directly
    try:
        main()
    except Exception as e:
        print(f"An error occurred: {e}")
        sys.exit(1)
