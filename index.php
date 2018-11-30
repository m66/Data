<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin's Data</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
<div class="dataInfo">
    <div class="header">
        <div><button class="addButton" type="submit" id="addBtn">Add new Employee</button></div>
        <div id="addNew" style="display: none"></div>
        <div class="search">
            <input type="text" placeholder="search" id="inp" oninput="myFunction()"/>
        </div>
    </div>
    <div class="dataTable">
        <table class="tbl" style="width: 100%; text-align: center">
            <tr style="background: #333; color: #fff">
                <th>Name</th>
                <th style="width: 70px;">Age</th>
                <th style="width: 200px;">Nickname</th>
                <th style="width: 200px;">Actions</th>
            </tr>
        </table>
    </div>
</div>
</body>
<script>
    $(document).ready(function () {
        $.ajax({
            url:'server.php',
            type:'post',
            data:{a:'search'},
            dataType:'json',
            success:function (r) {
                console.log(r);
                r.forEach(function (item) {
                    let tabl = $(`
                                <tr class="tr" name='${item.id}'>
                                    <td>${item.name}</td>
                                    <td>${item.age}</td>
                                    <td>${item.nickName}</td>
                                    <td style="width: 200px; display: flex; justify-content: space-around;"><button class="edit" style="width: 60px;">Edit</button><button class="delete" style="width: 60px;">Delete</button></td>
                                </tr>
                            `);
                    $("table").append(tabl);
                });
            }
        })
    });

    function myFunction() {
        $(".tr").remove();
        var inputVal = $('#inp').val();
        console.log(inputVal);
        $.ajax({
            url:'server.php',
            type:'post',
            data:{a:'search1',inputVal:inputVal},
            dataType:'json',
            success:function (r) {
                console.log(r);
                r.forEach(function (item) {
                    let table = $(`
                                <tr  class='tr' name='${item.id}'>
                                    <td>${item.name}</td>
                                    <td>${item.age}</td>
                                    <td>${item.nickName}</td>
                                    <td style="width: 200px; display: flex; justify-content: space-around;"><button class="edit" style="width: 60px;">Edit</button><button class="delete" style="width: 60px;">Delete</button></td>
                                </tr>
                            `);
                    $(".tbl").append(table);
                });
            }
        })
    }

    $(document).on('click','.delete',function () {
        var x = confirm('Do you want delete this person?');
        var trId = $(this).parent().parent().attr('name');
        if (x) {
            $.ajax({
                url:'server.php',
                type:'post',
                data:{a:'delete',trId:trId},
                success:function (r) {
                    console.log(r);
                }
            });
            $(this).parent().parent().remove();
        }

    });


    var inpGrup = $(`
            <p><input type='text' name="name" placeholder="Name *"></p>
            <p><input type='text' name="age" placeholder="Age *"></p>
            <p><input type='text' name="nickName" placeholder="Nick Name"></p>
       `);
    $(inpGrup).appendTo('#addNew');


    $('#addBtn').click(function () {

        $("#addNew").slideToggle();
    })

</script>
</html>