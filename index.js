
   document.addEventListener('DOMContentLoaded', function() {
        const words = ['GRAPHICS DESIGNER', 'FRONT-END DEVELOPER', 'FRONT-END DESIGNER', 'UI / UX DESIGNER'];
        const dynamicWord = document.getElementById('dynamic-word');
        let currentWordIndex = 0;

        function typeWord(word, callback) {
            let index = 0;
            dynamicWord.textContent = ''; // Clear the text content

            function typing() {
                if (index < word.length) {
                    dynamicWord.textContent += word.charAt(index);
                    index++;
                    setTimeout(typing, 100); // Typing speed (in milliseconds)
                } else if (callback) {
                    setTimeout(callback, 1000); // Delay before starting to erase
                }
            }
            typing();
        }

        function eraseWord(word, callback) {
            let index = word.length;
            
            function erasing() {
                if (index > 0) {
                    dynamicWord.textContent = word.substring(0, index);
                    index--;
                    setTimeout(erasing, 50); // Erasing speed (in milliseconds)
                } else if (callback) {
                    setTimeout(callback, 500); // Delay before typing the next word
                }
            }
            erasing();
        }

        function updateText() {
            const word = words[currentWordIndex];
            typeWord(word, function() {
                eraseWord(word, function() {
                    currentWordIndex = (currentWordIndex + 1) % words.length;
                    updateText(); // Continue with the next word
                });
            });
        }

        // Start the animation
        updateText();
    });

