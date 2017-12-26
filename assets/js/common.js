(function(){
    var id = document.getElementById('submitSignUpForm');

    if(id)
    id.addEventListener('click', function(event){
        event.stopPropagation();
        // @todo form validation
        var form = document.forms;
        console.log(form);
    });
})();