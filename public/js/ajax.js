let input = document.querySelector('#firstName');
let usersList = document.querySelector('#usersList');

function asyncRequest() {
    let $value = document.querySelector('#firstName').value;
    console.log($value);
    fetch(`autocomplete/` + $value)
        .then(function(response) {
            return response.json();
        }).then(function(data){
        
    })
}

input.addEventListener('keypress', asyncRequest, true);
