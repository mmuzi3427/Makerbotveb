const form = document.getElementById('queryForm');
const messageField = document.getElementById('message');
const charCount = document.getElementById('charCount');

form.addEventListener('submit', function(event) {
    event.preventDefault();
    
    const name = document.getElementById('name').value;
    const phone = document.getElementById('phone').value;
    const type = document.getElementById('type').value;
    const message = messageField.value;

    const query = {
        name: name,
        phone: phone,
        type: type,
        message: message  
    };

    fetch('submit_query.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(query)
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        form.reset();
        charCount.textContent = '0 / 500';
    })
    .catch(error => console.error('Error:', error));
});

messageField.addEventListener('input', function() {
    charCount.textContent = `${messageField.value.length} / 500`;
});