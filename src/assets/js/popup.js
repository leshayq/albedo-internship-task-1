function openPopup() {
    const popup = document.getElementById('popup');
    const overlay = document.getElementById('overlay');
    
    popup.classList.remove('hidden');
    overlay.classList.remove('hidden');

    document.getElementById('copy-btn').addEventListener('click', function() {
        const textArea = document.getElementById('popup-text');
        textArea.select();
        document.execCommand('copy');
    });
}

function closePopup() {
    const popup = document.getElementById('popup');
    const overlay = document.getElementById('overlay');
    
    popup.classList.add('hidden');
    overlay.classList.add('hidden');
}

document.getElementById('overlay').addEventListener('click', closePopup);