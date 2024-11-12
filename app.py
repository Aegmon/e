# Importing the required packages
import numpy as np
import pandas as pd
from sklearn.metrics import confusion_matrix, accuracy_score, classification_report
from sklearn.model_selection import train_test_split
from sklearn.tree import DecisionTreeClassifier, plot_tree
import matplotlib.pyplot as plt

# Function to import the dataset from an Excel file
def importdata():
    # Read the dataset from the Excel file
    balance_data = pd.read_excel('ELIGIBLE AND INELIGIBLE.xlsx')

    # Encoding 'Indigent' column to numeric (1 for 'Yes', 0 for 'No')
    balance_data['Indigent'] = balance_data['Indigent'].map({'Yes': 1, 'No': 0})

    # Displaying dataset information
    print("Dataset Length: ", len(balance_data))
    print("Dataset Shape: ", balance_data.shape)
    print("Dataset Head: \n", balance_data.head())
    
    return balance_data

# Function to split the dataset into training and test sets
def splitdataset(balance_data):
    # Defining feature columns (GWA and Income) and target column (Eligibility Status)
    X = balance_data[['GWA', 'Income']].values  # Only 'GWA' and 'Income' included
    Y = balance_data['Eligibility Status'].values

    # Splitting the dataset into train and test
    X_train, X_test, y_train, y_test = train_test_split(X, Y, test_size=0.3, random_state=100)

    return X, Y, X_train, X_test, y_train, y_test

# Function to train using Gini index with increased depth
def train_using_gini(X_train, y_train):
    # Creating the classifier object with increased depth
    clf_gini = DecisionTreeClassifier(criterion="gini", random_state=100, max_depth=10, min_samples_leaf=5)
    # Performing training
    clf_gini.fit(X_train, y_train)
    return clf_gini

# Function to train using entropy with increased depth
def train_using_entropy(X_train, y_train):
    # Decision tree with entropy and increased depth
    clf_entropy = DecisionTreeClassifier(criterion="entropy", random_state=100, max_depth=10, min_samples_leaf=5)
    # Performing training
    clf_entropy.fit(X_train, y_train)
    return clf_entropy

# Function to make predictions
def prediction(X_test, clf_object):
    y_pred = clf_object.predict(X_test)
    print("Predicted values:", y_pred)
    return y_pred

# Function to calculate and display accuracy metrics
def cal_accuracy(y_test, y_pred):
    print("Confusion Matrix:\n", confusion_matrix(y_test, y_pred))
    print("Accuracy: ", accuracy_score(y_test, y_pred) * 100, "%")
    print("Classification Report:\n", classification_report(y_test, y_pred))

# Function to print feature importance (now considering only GWA and Income)
def print_feature_importance(clf, feature_names):
    importance = clf.feature_importances_
    print("Feature Importance (how much each feature contributes to predicting eligibility):")
    for i, v in enumerate(importance):
        print(f"Feature: {feature_names[i]}, Score: {v:.5f}")

# Function to visualize the decision tree
def plot_decision_tree(clf_object, feature_names, class_names, zoom_scale=1.5):
    # Set a larger figure size for zooming effect
    plt.figure(figsize=(15 * zoom_scale, 10 * zoom_scale))
    # Plot the decision tree with larger font sizes
    plot_tree(clf_object, 
              filled=True, 
              feature_names=feature_names, 
              class_names=class_names, 
              rounded=True, 
              fontsize=12 * zoom_scale)
    plt.show()
if __name__ == "__main__":
    # Load and split data
    data = importdata()
    X, Y, X_train, X_test, y_train, y_test = splitdataset(data)

    # Train models using Gini and Entropy
    clf_gini = train_using_gini(X_train, y_train)
    clf_entropy = train_using_entropy(X_train, y_train)


    plot_decision_tree(clf_gini, ['GWA', 'Income'], ['Eligible', 'Ineligible'], zoom_scale=2)
    plot_decision_tree(clf_entropy, ['GWA', 'Income'], ['Eligible', 'Ineligible'], zoom_scale=2)


    # Feature importance for both models (now considering only GWA and Income)
    print("Feature importance for Gini model:")
    print_feature_importance(clf_gini, ['GWA', 'Income'])
    
    print("\nFeature importance for Entropy model:")
    print_feature_importance(clf_entropy, ['GWA', 'Income'])

    # Check the distribution of 'GWA' values
    print(data['GWA'].value_counts())

    # Operational Phase with Gini index
    print("Results Using Gini Index:")
    y_pred_gini = prediction(X_test, clf_gini)
    cal_accuracy(y_test, y_pred_gini)

    # Operational Phase with Entropy
    print("Results Using Entropy:")
    y_pred_entropy = prediction(X_test, clf_entropy)
    cal_accuracy(y_test, y_pred_entropy)
