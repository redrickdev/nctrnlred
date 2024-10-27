<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Design Gallery</title>
    <link rel="stylesheet" href="portfolio.css">
    <style>
        /* Reset and global styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Header styling */
        header {
            width: 100%;
            background-color: #121212;
            color: #fff;
            padding: 1.5rem 0;
            text-align: center;
            margin-bottom: 2rem;
        }

        header h1 {
            font-size: 2rem;
            font-weight: 700;
        }

        /* Gallery styling */
        .gallery {
            display: flex;
            flex-wrap: wrap; /* Allow wrapping for grid layout */
            justify-content: space-between; /* Distribute items evenly */
            max-width: 100%; /* Use full width */
            padding: 0; /* Remove padding */
            margin: 0; /* Remove margins */
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
            flex: 1 1 calc(33.33% - 1rem); /* Responsive sizing */
            margin: 0.5rem; /* Space between items */
            height: 200px; /* Set a fixed height for consistency */
        }

        .gallery-item img {
            display: block;
            width: 100%; /* Full width */
            height: 100%; /* Fill the height of the container */
            object-fit: cover; /* Cover the entire area */
            border-bottom: 2px solid #ddd; /* This line can be kept or modified as needed */
        }

        .gallery-item:hover {
            transform: translateY(-5px);
        }

        /* Download button styling */
        .download-btn {
            display: flex; /* Use flex to center text */
            align-items: center; /* Vertically center the text */
            justify-content: center; /* Horizontally center the text */
            padding: 0.75rem; /* Default padding */
            background-color: #355268;
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            border-radius: 0 0 8px 8px;
            transition: background-color 0.3s ease;
            flex-grow: 1; /* Allow the button to grow */
            min-width: 100%; /* Ensure full width in smaller screens */
        }

        /* Responsive text size */
        .download-btn {
            font-size: 1rem; /* Default font size */
        }

        @media (max-width: 640px) {
            .download-btn {
                font-size: 0.8rem; /* Smaller font size for mobile */
                padding: 0.5rem; /* Adjust padding for mobile */
            }
        }

        .download-btn:hover {
            background-color: #002f5f;
        }

        /* Modal styling */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1000; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.8); /* Black background with opacity */
            justify-content: center; /* Center the modal */
            align-items: center; /* Center the modal */
            padding: 20px; /* Padding around modal content */
        }

        .modal img {
            max-width: 90%; /* Limit image width */
            max-height: 90%; /* Limit image height */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Shadow for the modal image */
        }

        .close {
            position: absolute;
            top: 20px;
            right: 30px;
            color: white;
            font-size: 2rem;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close:hover {
            color: #ff0000; /* Change color on hover */
        }
    </style>
</head>
<body>
<div id="spinner-wrapper">
      <div class="spinner">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>
    <header>
        <h1>Graphic Design Gallery</h1>
    </header>

    <section class="gallery">
        <?php
        // Directory where images are stored
        $dir = "images/";
        // Fetch all image files with supported formats
        $images = glob($dir . "*.{jpg,png,jpeg,gif}", GLOB_BRACE);

        foreach($images as $image) {
            echo '
            <div class="gallery-item">
                <img src="' . $image . '" alt="Design Image" class="gallery-img" onclick="openModal(\'' . $image . '\')">
                <a href="download.php?file=' . basename($image) . '" class="download-btn">Download in HD</a>
            </div>';
        }
        ?>
    </section>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="modalImage" alt="Modal Image">
    </div>
    <script>
      // Hide the spinner after 3 seconds and smoothly show the main content
      window.addEventListener("load", function () {
        setTimeout(function () {
          // Start fading out the spinner
          document.getElementById("spinner-wrapper").style.opacity = "0";
    
          // Wait for the fade-out animation to finish (0.5s), then hide the spinner and show the content
          setTimeout(function () {
            document.getElementById("spinner-wrapper").style.display = "none";
            document.getElementById("main-content").style.opacity = "1"; // Fade in the main content
          }, 500); // 500ms corresponds to the fade-out duration
        }, 1000); // Spinner stays for 3 seconds
      });
    </script>
    <script>
        // Open the modal and display the clicked image
        function openModal(imageSrc) {
            const modal = document.getElementById("myModal");
            const modalImage = document.getElementById("modalImage");
            modal.style.display = "flex"; // Show the modal
            modalImage.src = imageSrc; // Set the clicked image as source
        }

        // Close the modal
        function closeModal() {
            const modal = document.getElementById("myModal");
            modal.style.display = "none"; // Hide the modal
        }

        // Close the modal when clicking outside the image
        window.onclick = function(event) {
            const modal = document.getElementById("myModal");
            if (event.target === modal) {
                closeModal();
            }
        };
    </script>
</body>
</html>
