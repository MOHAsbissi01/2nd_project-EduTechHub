<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Books API Example</title>
</head>
<body>
    <h1>Search for Books</h1>
    <input type="text" id="searchInput" placeholder="Enter a book title or author">
    <button onclick="searchBooks()">Search</button>
    <div id="results"></div>

    <style>
          
                /* Athletic-style animation */
        @keyframes pulse {
            0% {
                transform: scale(1);
                background-color: #ff0000; /* Red */
            }
            50% {
                transform: scale(1.1);
                background-color: #0000ff; /* Blue */
            }
            100% {
                transform: scale(1);
                background-color: #ff0000; /* Red */
            }
        }

        /* Apply the animation to an element */
        .my-athletic-element {
            width: 100px;
            height: 100px;
            background-color: #ff0000; /* Red */
            animation: pulse 2s infinite alternate; /* Alternate between keyframes */
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #ffffff; /* White text */
            font-weight: bold;
            font-size: 16px;
        }

        /* Optional: Add hover effect */
        .my-athletic-element:hover {
            transform: scale(1.1);
            background-color: #0000ff; /* Blue */
        }
        
        /* Optional: Add a border */
        .my-athletic-element {
            border: 2px solid #000000; /* Black */
        }

        /* Optional: Add padding */
        .my-athletic-element {
            padding: 10px;
        }

        /* Optional: Add margin */

        .my-athletic-element {
            margin: 10px;
        }

        /* Optional: Add a shadow */
        .my-athletic-element {
            box-shadow: 5px 5px 5px #888888; /* Gray shadow */
        }

        /* Optional: Add a border radius */
        .my-athletic-element {
            border-radius: 50%;
        }

        body {
            background-color: #ffffff ;
            color: #000000;
            font-family: 'Helvetica', sans-serif;
            text-align: center;
            padding: 20px;
            animation: fadeIn 1s ease-in-out;
        }
        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            letter-spacing: 2px;
            animation: slideInDown 1s ease-in-out;
        }
        p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 30px;
            animation: fadeInUp 1s ease-in-out;
        }
        img {
            max-width: 100%;
            height: auto;
            margin-top: 20px;
            border: 2px solid #fff;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
            animation: zoomIn 1s ease-in-out;
        }
        .space-tab {
            background-color: #111;
            padding: 30px;
            border-radius: 10px;
            margin-top: 40px;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
            animation: pulse 2s infinite alternate;
        }

        /* Keyframe animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /*input */

        input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
        }
        /*button */
        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>

    <script>
        async function searchBooks() {
            const apiKey = 'AIzaSyDzD8nkRROa0qyVdWjuIwk0Zj2SE1Mq6Mk'; // Replace with your actual API key
            const query = document.getElementById('searchInput').value;

            try {
                const response = await fetch(`https://www.googleapis.com/books/v1/volumes?q=${query}&key=${apiKey}`);
                const data = await response.json();

                const resultsDiv = document.getElementById('results');
                resultsDiv.innerHTML = ''; // Clear previous results

                data.items.forEach(book => {
                    const title = book.volumeInfo.title;
                    const authors = book.volumeInfo.authors ? book.volumeInfo.authors.join(', ') : 'Unknown Author';
                    const description = book.volumeInfo.description || 'No description available';
                    const thumbnail = book.volumeInfo.imageLinks?.thumbnail || 'https://via.placeholder.com/150';

                    const bookCard = `
                        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 20px;">
                            <img src="${thumbnail}" alt="${title}" style="max-width: 100px;">
                            <h3>${title}</h3>
                            <p>Author(s): ${authors}</p>
                            <p>${description}</p>
                            <p>${thumbnail}</p>
                        </div>
                    `;

                    resultsDiv.innerHTML += bookCard;
                });
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }
    </script>
</body>
</html>
