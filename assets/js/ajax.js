

let plantes = document.getElementById('plantes');
let apply = document.getElementById('apply');
let checkedCateg = document.querySelectorAll('.checkedCateg');




checkedCateg.forEach(item => {
    item.addEventListener('click', () => {
        item.checked ? item.removeAttribute("checked") : item.setAttribute("checked", "checked");
        const checkedCheckboxes = document.querySelectorAll(".checkedCateg:checked");
        console.log( Array.from(checkedCheckboxes).map(checkbox => checkbox.value)) });
});


apply.addEventListener('click', (e) => {
    e.preventDefault();
    const checkedCheckboxes = document.querySelectorAll(".checkedCateg:checked");
    const data = Array.from(checkedCheckboxes).map(checkbox => checkbox.value);

    // Use fetch API to send data to text.php
    fetch('../../controller/ajax.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ data: data }),
    })
        .then(response => response.json())
        .then(data => {
            // Handle the response from the server if needed
            console.log(data);
        })
        .catch(error => {
            // Handle errors
            console.error('Error:', error);
        });
});
