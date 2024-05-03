$(function(){

    function selectHighlightedUsers(){
        idUsers = {};
        i=-1;
        $('input[type=checkbox]').each(function(){
            if(this.checked === true && this.getAttribute('name') !== 'all'){
                idUsers[++i]=(this.getAttribute('name'));
            }
        });
        return idUsers;
    }

    function ajaxRequest (path)
    {
        data = selectHighlightedUsers();
        $.ajax({
            url: path, 
            method: 'POST',
            data: data,
            success: function (response) {
                if (response!= null){
                    response = JSON.parse(response);
                    $('table').html(response);
                }
            },
            error: function (error) {
                alert("Ошибка при отправке данных: ", error);
            },
        });        
    }

    function checkStateMainCheckbox(){
        checkBoxes = $('tbody input[type=checkbox]');
        numberIncluded = 0;
        checkBoxes.each(function(){
            if(this.checked)
                ++numberIncluded;
        })
        $('input[type=checkbox][name=all]').prop('checked',false);
        if(numberIncluded === checkBoxes.length)
            $('input[type=checkbox][name=all]').prop('checked',true);
    }

    $(document.body).on('change', 'input[type=checkbox][name=all]',function(){
        $('input[type=checkbox]').prop('checked',this.checked);  
        console.log($('input[type=checkbox]'));          
    })


    $(document.body).on('click', 'tbody tr', function(event) {
        checkBox = $(this).find('input[type=checkbox]');
        checkBox.each(function() {
            $(this).prop("checked", !$(this).prop("checked"));
        });
        checkStateMainCheckbox();
    })

    $(document.body).on('click', 'tbody input[type=checkbox]', function(event) {
        $(this).prop("checked", !$(this).prop("checked"));
        checkStateMainCheckbox();
    });

    $('#block').on('click',function(){
        ajaxRequest("/user/block");
        location.reload();
    });
    
    $('#unblock').on('click',function(){
        ajaxRequest("/user/unblock");
    });

    $('#delete').on('click',function(){
        ajaxRequest("/user/delete");
        location.reload();
    });
})