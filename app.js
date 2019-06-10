
$(function() {
    let edit = false;
    console.log('Jquery funciona');
    $('#task-result').hide();
    fetchTasks();

    $('#search').keyup(function() {
        if($('#search').val()) {
            let search = $('#search').val();
            console.log(search);
            $.ajax({
                url: 'task-search.php',
                type: 'POST',
                data: {search},
                success: function(response) {
                    let tasks = JSON.parse(response, null);
                    let template = '';
                    tasks.forEach(task => {
                        template += `
                        <li>
                        ${task.name}
                        </li>
                        `
                    });
                    $('#container').html(template);
                    $('#task-result').show();
                }
            });
        }
    });
    $('#task-form').submit(function(evento) {
        const postData = {
            name: $('#name').val(),
            description: $('#description').val(),
            taskId: $('#taskId').val(),
        };
        console.log(postData);

        let url = edit === false ? 'task-add.php': 'task-edit.php';
        if(postData.name !=='' && postData.description !=='') {
            $.post(url, postData, function(response) {
                fetchTasks();
                $('#task-form').trigger('reset');
            });
        }
        evento.preventDefault();
        
    });

    function fetchTasks() {
        edit = false;
        $.ajax({
            url: 'task-list.php',
            type: 'GET',
            success: function(response) {
                let tasks = JSON.parse(response);
                let template = '';
                tasks.forEach(task => {
                    template += `
                            <tr taskId="${task.id}">
                                <td>${task.id}</td>
                                <td>
                                    <a href="#" class="task-item">${task.name}</a>
                                </td>
                                <td>${task.description}</td>
                                <td>
                                    <button class="task-delete btn btn-danger text-uppercase text-white">delete</button>
                                </td>
                            </tr>
                            `
                });
                $('#tasks').html(template);
    
            }
        });
    }

    $(document).on('click', '.task-delete', function() {
        if(confirm('¿Estás seguro de querer borrar esta tarea?')) {
            let element = $(this)[0].parentElement.parentElement;
            let id = $(element).attr('taskId');
            $.post("task-delete.php", {id}, function(response) {
                fetchTasks();
            });
        }
    });

    $(document).on('click', '.task-item', function() {
        let element =  $(this)[0].parentElement.parentElement;
        let id = $(element).attr('taskId');
        console.log(id);
        $.post('task-single.php', {id}, function(response) {
            const task = JSON.parse(response);
            $('#name').val(task.name);
            $('#description').val(task.description);
            $('#taskId').val(task.id);
            edit = true;
        })
    })
});