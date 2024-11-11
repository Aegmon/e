function toggleSidebar() {
    const sidebar = document.getElementById('mySidebar');
    const main = document.getElementById('main');
    const menuButton = document.getElementById('menuToggle');
    
    if (sidebar.classList.contains('minimized')) {
        // Expand the sidebar
        sidebar.classList.remove('minimized');
        sidebar.style.width = '300px'; // Expanded width
        main.style.marginLeft = '300px'; // Adjust main content
        menuButton.innerHTML = '&#9776;'; // Adjust button content if needed
    } else {
        // Minimize the sidebar
        sidebar.classList.add('minimized');
        sidebar.style.width = '80px'; // Minimized width
        main.style.marginLeft = '80px'; // Adjust main content
        menuButton.innerHTML = '&#9776;'; // Adjust button content if needed
    }

    // Adjust menu button position based on sidebar state
    if (sidebar.classList.contains('minimized')) {
        menuButton.style.left = '80px'; // Adjust based on minimized sidebar width
    } else {
        menuButton.style.left = '270px'; // Adjust based on expanded sidebar width
    }
}

document.addEventListener("DOMContentLoaded", function() {
    var sidebar = document.getElementById("mySidebar");
    var main = document.getElementById("main");
    var menuButton = document.getElementById("menuToggle");

    sidebar.style.display = "block";
    sidebar.style.width = "300px"; 
    main.style.marginLeft = "300px";
    menuButton.innerHTML = "&#9776;"; 

    var dateContainer = document.getElementById("date-container");
    
    // Create a new Date object
    var now = new Date();
    
    // Format the date (e.g., July 30, 2024)
    var options = { year: 'numeric', month: 'long', day: 'numeric' };
    var formattedDate = now.toLocaleDateString(undefined, options);
    
    // Insert the formatted date into the container
    dateContainer.textContent = formattedDate;
});

document.getElementById('logoutButton').addEventListener('click', function() {
    // Example: Perform the logout action
    // Redirect to logout URL
    window.location.href = '/logout'; // Replace with your actual logout URL

    // Alternatively, clear session data if needed
    sessionStorage.clear();
    localStorage.clear();
});

document.addEventListener("DOMContentLoaded", function() {
// Select the form and the submit button
var form = document.getElementById("announcementForm");
var postButton = document.getElementById("post-button");

// Attach event listener to the form submission
form.addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get the form data
    var formData = new FormData(form);

    // Prepare the request options
    var requestOptions = {
        method: 'POST',
        body: formData,
        // Headers might be required depending on your server configuration
        // headers: {
        //     'Content-Type': 'application/x-www-form-urlencoded',
        // }
    };

    // Make the AJAX request to your server endpoint
    fetch('/your-server-endpoint', requestOptions)
        .then(response => response.json())
        .then(data => {
            // Handle the response from the server
            console.log('Success:', data);
            alert('Announcement posted successfully!'); // Display a success message or redirect
            form.reset(); // Reset the form fields
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('Failed to post announcement. Please try again.');
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Get references to DOM elements
    const emojiIcon = document.querySelector('.emoji-icon');
    const announcementText = document.getElementById('announcement-text');

    // Emoji picker functionality
    emojiIcon.addEventListener('click', function() {
        // Example emoji picker (could be replaced with a more complex implementation)
        const emoji = '😊'; // Example emoji
        insertAtCursor(announcementText, emoji);
    });

    // Function to insert text at the cursor position in a textarea
    function insertAtCursor(textarea, text) {
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const value = textarea.value;

        textarea.value = value.slice(0, start) + text + value.slice(end);
        textarea.selectionStart = textarea.selectionEnd = start + text.length;
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const maximizeButton = document.querySelector('.maximize-button');
    const modal = document.getElementById('announcement-modal');
    const closeModalButton = document.querySelector('.close-modal');
    const pageContent = document.getElementById('page-content');

    // Open the modal
    maximizeButton.addEventListener('click', function() {
        modal.style.display = 'block';
        pageContent.classList.add('modal-open');
    });

    // Close the modal
    closeModalButton.addEventListener('click', function() {
        modal.style.display = 'none';
        pageContent.classList.remove('modal-open');
    });

    // Close the modal if the user clicks outside of the modal content
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
            pageContent.classList.remove('modal-open');
        }
    });
});


document.addEventListener('DOMContentLoaded', function() {
    // Data for the pie chart
    var applicantStatusData = [{
        values: [40, 30, 30], // Example percentages
        labels: ['Eligible', 'Ineligible', 'Pending'],
        type: 'pie',
        marker: {
            colors: ['#CDFFC5', '#FFC5C5', '#C5D1FF'] // Colors for the segments
        },
        textinfo: 'label', // Display the label inside each segment
        textposition: 'inside', // Position the text inside the segments
        textfont: {
            size: 10, // Adjust the font size here
        }
    }];

    var pieLayout = {
        height: 122,
        width: 250,
        margin: { l: 0, r: 0, b: 0, t: 0 },
        showlegend: false
    };

    Plotly.newPlot('applicant-status-chart', applicantStatusData, pieLayout);

    // Data for the bar chart
    var scholarStatusData = [{
        x: ['Full Scholar', 'Grantee Level 1', 'Grantee Level 2'],
        y: [100, 60, 40], // Example numbers
        type: 'bar',
        marker: {
            color: ['#CDFFC5', '#FFC5C5', '#C5D1FF'] // Colors for the bars
        }
    }];

    var barLayout = {
        height: 102,
        width: 220,
        margin: { l: 40, r: 0, b: 30, t: 0 },
        yaxis: {
            automargin: true,
        },
        xaxis: {
            automargin: true,
            tickangle: 0, // Rotate labels to avoid overlap
        tickfont: {
            size: 7 // Set font size for x-axis labels
        }
        }
    };

    Plotly.newPlot('scholar-status-chart', scholarStatusData, barLayout);
});

document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('file-input');
    const imageInput = document.getElementById('image-input');
    const fileIconsContainer = document.getElementById('file-icons-container');
    const attachFileIcon = document.getElementById('file-icon');
    const photoLibraryIcon = document.getElementById('photo-icon');
    const emojiIcon = document.getElementById('emoji-icon');
    const modalTextArea = document.getElementById('modal-text-area');
    const emojiPicker = document.getElementById('emoji-picker');
    const emojiList = document.getElementById('emoji-list');

    function updateFileIcons() {
        const files = Array.from(fileInput.files).concat(Array.from(imageInput.files));
        fileIconsContainer.innerHTML = ''; // Clear previous icons

        if (files.length === 0) {
            return; // No files selected, exit the function
        }

        files.forEach(file => {
            const fileType = file.type.split('/')[0];
            const fileExtension = file.name.split('.').pop().toLowerCase();
            let iconName;

            const fileIconContainer = document.createElement('div');
            fileIconContainer.classList.add('file-icon-container');

            const icon = document.createElement('span');
            icon.classList.add('material-symbols-rounded');
            
            const removeButton = document.createElement('span');
            removeButton.classList.add('material-symbols-rounded', 'remove-button');
            removeButton.textContent = 'close'; // 'close' icon for remove button

            removeButton.addEventListener('click', () => {
                const newFiles = Array.from(fileInput.files).filter(f => f !== file);
                const newImages = Array.from(imageInput.files).filter(f => f !== file);

                // Create a new FileList object with the remaining files
                const dataTransfer = new DataTransfer();
                newFiles.forEach(f => dataTransfer.items.add(f));
                fileInput.files = dataTransfer.files;

                const imageTransfer = new DataTransfer();
                newImages.forEach(f => imageTransfer.items.add(f));
                imageInput.files = imageTransfer.files;

                updateFileIcons();
            });

            if (fileType === 'image') {
                iconName = 'photo'; // Icon for images
                
                // Create an image preview
                const img = document.createElement('img');
                img.classList.add('file-preview');
                img.src = URL.createObjectURL(file);
                fileIconContainer.appendChild(img);
            } else if (fileType === 'application') {
                switch (fileExtension) {
                    case 'pdf':
                        iconName = 'picture_as_pdf';
                        break;
                    case 'doc':
                    case 'docx':
                        iconName = 'description';
                        break;
                    case 'xls':
                    case 'xlsx':
                        iconName = 'grid_on';
                        break;
                    case 'ppt':
                    case 'pptx':
                        iconName = 'slideshow';
                        break;
                    default:
                        iconName = 'insert_drive_file';
                }
            } else {
                iconName = 'insert_drive_file'; // Default icon for unknown file types
            }

            icon.textContent = iconName;

            const fileName = document.createElement('p');
            fileName.textContent = file.name.length > 10 ? file.name.slice(0, 10) + '...' : file.name;

            fileIconContainer.appendChild(removeButton);
            fileIconContainer.appendChild(icon);
            fileIconContainer.appendChild(fileName);
            fileIconsContainer.appendChild(fileIconContainer);
        });

        // Reset photoLibraryIcon display if no images are selected
        if (Array.from(imageInput.files).length === 0) {
            photoLibraryIcon.style.display = 'inline-block';
        }
    }

    fileInput.addEventListener('change', updateFileIcons);
    imageInput.addEventListener('change', updateFileIcons);

    function triggerFileInput(input) {
        input.click();
    }

    attachFileIcon.addEventListener('click', function() {
        triggerFileInput(fileInput); // Open file manager for allowed file types
    });

    photoLibraryIcon.addEventListener('click', function() {
        triggerFileInput(imageInput); // Open file manager for images only
    });

});