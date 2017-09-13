<?php
    include 'header.php';
?>

<style type="text/css">
   /* .btn{
        background-color: #333;
        border-color: #999;
        font-size: 13px;
    }
    .btn:hover{
        background-color: #999;
        border-color: #333;
        font-size: 13px;
    }*/
    /*body{
        background-color: #ccc;
    }
    .container{
        background-color: #fff;
        padding: 55px;
        padding-top: 20px;
        padding-bottom: : 20px;
        border-radius: 8px;
        margin-top: 40px;
        margin-bottom: 40px;
        margin-right: auto;
        margin-left: auto;
    }*/
    table {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
        font-style: normal;
        text-decoration: none;
        border-collapse:collapse;
        border-color: #2e6da4;
        word-wrap: break-word;
    }
    .highlight_row {
        /*background: #999;*/
        background-color:#cdf;
        /*color: #fff;*/
    }
    /*tr:nth-child(even) {
        background-color: #DBDBDB;
        background-color: #e8edff;
    }*/
    label{
      font-size: 1.2rem;
    }
    tbody tr:hover {
        /*background: #999;*/
        background-color:#cdf;
        /*color: #fff;*/
    }
    h3{
        font-family: 'Amatic SC', cursive;
        font-size: 55px;
    }
    /*table tr th, table tr td{font-size: 1.2rem;}*/
    .panel-body{ margin:5px 5px 5px 5px;width: 100%;}
    .glyphicon{font-size: 14px;}
    .glyphicon-plus, .glyphicon-cog{float: right;}
    a.glyphicon{text-decoration: none;}
    a.glyphicon-trash{margin-left: 10px;}
    .none{display: none;}
    th {
        background-color: #337ab7;
        color: #FFF;
    }
    th a:link {
        text-decoration: none;
        color: #FFF;
    }
    th a:visited {
        text-decoration: none;
        color: #FFF;
    }
    th a:hover {
        text-decoration: none;
        color: #FFF;
    }
    th a:active {
        text-decoration: none;
        color: #FFF;
    }
    th, td{
        padding: 2px;
    }
        
</style>



<script>


function addFilePreview(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#userForm + img').remove();
                $('#addThumbnail').html('<img id="imageAdd" src="'+e.target.result+'" width="450" height="300"/>');
                //$('#userForm + embed').remove();
                //$('#userForm').after('<embed src="'+e.target.result+'" width="450" height="300">');
            }
            reader.readAsDataURL(input.files[0]);
        }

}

function editFilePreview(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#userForm + img').remove();
                $('#editThumbnail').html('<img id="imageEdit" src="'+e.target.result+'" width="450" height="300"/>');
                //$('#userForm + embed').remove();
                //$('#userForm').after('<embed src="'+e.target.result+'" width="450" height="300">');
            }
            reader.readAsDataURL(input.files[0]);
        }

}

// $("#addFile").change(function () {
//     filePreview(this);
// });

function searchUsers(val,searchCol,sortCol,limit, order){

    // $('#sortCol').val(sortCol);

    if (order == 'ASC') {
       order = 'DESC';
       arrow = '&nbsp;<span class="glyphicon glyphicon-sort-by-attributes-alt"></span>';
    } else {
       order = 'ASC';
       arrow = '&nbsp;<span class="glyphicon glyphicon-sort-by-attributes"></span>';
    }

    var sendData = 'val='+val+'&searchCol='+searchCol+'&sortCol='+sortCol+'&limit='+limit+'&totalitems=1&adjacents=2'+'&order='+order;

    $.ajax({
        type: 'POST',
        url: 'getData.php',
        data: sendData,
        // beforeSend:function(html){
        //     $('.loading-overlay').show();
        // },
        success:function(html){
            // $('.loading-overlay').hide();
            $('#displayData').html(html);
            $('#'+sortCol+'').append(arrow);
        }
    });

    $.ajax({
        type: 'POST',
        url: 'getPage.php',
        data: sendData,
        // beforeSend:function(html){
        //     $('.loading-overlay').show();
        // },
        success:function(html){
            // $('.loading-overlay').hide();
            $('#pages').html(html);
        }
    });
}

function getUsers(){
    $.ajax({
        type: 'POST',
        url: 'userAction.php',
        data: 'action_type=view&'+$("#userForm").serialize(),
        success:function(html){
            $('#displayData').html(html);
        }
    });
}

// function printPageArea(areaID){
//     var printContent = document.getElementById(areaID);
//     var WinPrint = window.open('', '', 'width=900,height=650');
//     WinPrint.document.write(printContent.innerHTML);
//     WinPrint.document.close();
//     WinPrint.focus();
//     WinPrint.print();
//     WinPrint.close();
// }

function printPageArea(areaID){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(areaID).innerHTML;
    $('link[href="assets/css/bootstrap.min.css"]').attr('href', '#');
    document.body.innerHTML = printcontent;
    window.print();
    $('link[href="#"]').attr('href', 'assets/css/bootstrap.min.css');
    // location.reload();
    document.body.innerHTML = restorepage;
}

$(document).ready(function() {

    //Disable mouse right click
    $("body").on("contextmenu",function(e){
        return false;
    });


    $("input:checkbox:not(:checked)").each(function() {
        var column = "table ." + $(this).attr("name");
        $(column).hide();
    });

    $("input:checkbox").click(function(){
        var column = "table ." + $(this).attr("name");
        $(column).toggle();
    });


     $('#select_all').on('click',function(){
        if(this.checked){
            $('.check_box').each(function(){
                this.checked = true;
                var column = "table ." + $(this).attr("name");
                $(column).toggle();
            });
        }else{
             $('.check_box').each(function(){
                this.checked = false;
                var column = "table ." + $(this).attr("name");
                $(column).hide();
            });
        }
    });
    
    $('.check_box').on('click',function(){
        if($('.check_box:checked').length == $('.check_box').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });

    

    $(document).on('click','.table-row', function (event) {
        // if (event.target.type !== 'checkbox') {
            // $(':checkbox', this).trigger('click');
            $(this).toggleClass('highlight_row');
        // }
    });

    $("#create_excel").click(function(e) {
       e.preventDefault();

       //getting data from our table
       var data_type = 'data:application/vnd.ms-excel';
       var table_div = document.getElementById('displayData');
       var table_html = table_div.outerHTML.replace(/ /g, '%20');

       var a = document.createElement('a');
       a.href = data_type + ', ' + table_html;
       a.download = 'exported_table_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
       a.click();
     });

    $('#btn_delete').click(function() {
        if (confirm('Are you sure you want to delete this?')) {
            var id = [];
            $('td :checkbox:checked').each(function(i) {
                id[i] = $(this).val();
            });
            if (id.length === 0) {
                alert('Please select atleast one checkbox');
            }else{
                $.ajax({
                    url: 'delete.php',
                    method: 'POST',
                    data: {id:id},
                    success:function(){
                            for (var i = 0; i < id.length; i++) {
                                $('tr#'+id[i]+'').css('background-color', '#ccc');
                                $('tr#'+id[i]+'').fadeOut('slow');
                            }
                    }
                });
            }
        } else {
            return false;
        }
    });

    $('#btn_card').click(function() {
            var id = [];
            $('td :checkbox:checked').each(function(i) {
                id[i] = $(this).val();
            });
            if (id.length === 0) {
                alert('Please select atleast one checkbox');
            }else{
                $.ajax({
                    url: 'card.php',
                    method: 'POST',
                    data: {id:id},
                    success:function(html){
                        for (var i = 0; i < id.length; i++) {
                            $('tr#'+id[i]+'').css('background-color', '#ccc');
                            $('tr#'+id[i]+'').fadeOut('slow').fadeIn('slow');
                            $('tr#'+id[i]+'').css('background-color', '#fff');
                        }
                        $('#card').append(html);
                }
                });
            }
    });

    $('#displayData').load('getData.php');
    $('#pages').load('getPage.php');


    $('#pages').on('click', 'a', function(event) {
        event.preventDefault();
        var page = $(this).attr('data-page');
        // alert(page);
        var searchInput = $('#searchInput').val(); 
        var searchCol = $('#searchCol').val(); 
        var sortCol = $('#sortCol').val();
        var limit = $('#limit').val();
        var order = $('#sort').val();

        if (order == 'ASC') {
           order = 'DESC';
           arrow = '&nbsp;<span class="glyphicon glyphicon-sort-by-attributes-alt"></span>';
        } else {
           order = 'ASC';
           arrow = '&nbsp;<span class="glyphicon glyphicon-sort-by-attributes"></span>';
        }

        // $('#sortCol').val(sortCol);

        // var sortCol = $(this).attr("id");  
        // var order = $(this).data("order");  
        // alert(sortCol + order);
        // var arrow = '';  
        //glyphicon glyphicon-sort-by-attributes  
        //glyphicon glyphicon-sort-by-attributes-alt  

        // if(order == 'desc')  
        // {  
        //      arrow = '&nbsp;<span class="glyphicon glyphicon-sort-by-attributes-alt"></span>';  
        // }  
        // else  
        // {  
        //      arrow = '&nbsp;<span class="glyphicon glyphicon-sort-by-attributes"></span>';  
        // }

        var sendData = 'page='+page+'&totalitems=1&limit='+limit+'&adjacents=2&searchCol='+searchCol+'&sortCol='+sortCol+'&val='+searchInput+'&order='+order;

        $.ajax({
           type: 'POST',
           url: 'getData.php',
           data: sendData,
           success: function(data){
                $('#displayData').html(data);
                $('#'+sortCol+'').append(arrow);
           }
        });

        $.ajax({
           type: 'POST',
           url: 'getPage.php',
           data: sendData,
           success: function(data){
                $('#pages').html(data);
           }
        });

    });


  $('#displayData').on('click', '.column_sort', function(event){  
       event.preventDefault(); 
       var searchInput = $('#searchInput').val(); 
       var searchCol = $('#searchCol').val(); 
       // var sortCol = $('#sortCol').val();
       var limit = $('#limit').val();

       var sortCol = $(this).attr('id');  
       // var order = $(this).attr('data-order');  
       var order = $('#sort').val();  
       // alert(sortCol + order);
       var arrow = '';  
       // glyphicon glyphicon-sort-by-attributes  
       // glyphicon glyphicon-sort-by-attributes-alt  

       if(order == 'ASC'){
            arrow = '&nbsp;<span class="glyphicon glyphicon-sort-by-attributes"></span>';
       }else{
            arrow = '&nbsp;<span class="glyphicon glyphicon-sort-by-attributes-alt"></span>';
       }  

       var sendData = 'page=1&searchCol='+searchCol+'&sortCol='+sortCol+'&val='+searchInput+'&order='+order+'&limit='+limit;

       // var sendData = 'sortCol='+sortCol+'&order='+order;


       $.ajax({  
            url: 'getData.php',  
            method: 'POST',  
            data: sendData,  
            success:function(data){
                 $('#displayData').html(data);  
                 $('#'+sortCol+'').append(arrow);  
                 if (order == 'DESC') {
                    $('#sort').val('ASC');
                 } else {
                    $('#sort').val('DESC');
                 }
                 $('#sortCol').val(sortCol);

                 $.ajax({
                    type: 'POST',
                    url: 'getPage.php',
                    data: sendData,
                    success: function(data){
                         $('#pages').html(data);
                    }
                 });
            }  
       })  
  });  



    $('#addForm').children('form').on('submit', function(e) {
        e.preventDefault();

        var extension = $('#addFile').val().split('.').pop().toLowerCase();  
        if(extension != ''){ 
             if($.inArray(extension, ['gif','png','jpg','jpeg']) == -1){ 
                  alert("Invalid Image File");  
                  $('#addFile').val('');  
                  return false;  
             }  
        } 


        var addData = new FormData($(this)[0]);
        addData.append('action_type', 'add');

        $.ajax({
            type: 'POST',
            url: 'userAction.php',
            data: addData,
            processData: false,
            contentType: false,
            success:function(msg){
                if(msg == 'ok'){
                    alert('User data has been added successfully.');
                    searchUsers($('#searchInput').val(), $('#searchCol').val(), $('#sortCol').val(), $('#limit').val(), $('#sort').val());
                    $('.form')[0].reset();
                    $('.formData').slideUp();
                    $('#tbl_setting').slideUp();
                    $('#addForm').find('img').attr('src', 'blank.jpg');
                }else{
                    alert('Some problem occurred, please try again.');
                }
            }
        });

    });


    $('#editForm').children('form').on('submit', function(e) {
        e.preventDefault();

        var extension = $('#editFile').val().split('.').pop().toLowerCase();  
        if(extension != ''){ 
             if($.inArray(extension, ['gif','png','jpg','jpeg']) == -1){ 
                  alert("Invalid Image File");  
                  $('#editFile').val('');  
                  return false;  
             }  
        }

        var editData = new FormData($(this)[0]);
        editData.append('action_type', 'edit');

        $.ajax({
            type: 'POST',
            url: 'userAction.php',
            data: editData,
            processData: false,
            contentType: false,
            success:function(msg){
                if(msg == 'ok'){
                    alert('User data has been updated successfully.');
                    searchUsers($('#searchInput').val(), $('#searchCol').val(), $('#sortCol').val(), $('#limit').val(), $('#sort').val());
                    $('.form')[1].reset();
                    $('.formData').slideUp();
                    $('#tbl_setting').slideUp();
                    $('#editForm').find('img').attr('src', 'blank.jpg');
                }else{
                    alert('Some problem occurred, please try again.');
                }
            }
        });

    });

    // $('#editForm').children('form').on('submit', function(e) {
        

    //     var editData = new FormData($(this)[0]);
    //     editData.append('action_type', 'edit');

    //     $.ajax({
    //         type: 'POST',
    //         url: 'userAction.php',
    //         data: editData,
    //         processData: false,
    //         contentType: false,
    //         success:function(data){
    //                 alert(data);
    //         }
    //     });

    // });


});


    
function userAction(type, id){
   id = (typeof id == "undefined")?'':id;
   var statusArr = {add:"added",edit:"updated",delete:"deleted"};
   var userData = '';
   if (type == 'add') {
       userData = $("#addForm").find('.form').serialize()+'&action_type='+type+'&id='+id;
   }else if (type == 'edit'){
       userData = $("#editForm").find('.form').serialize()+'&action_type='+type;
   }else{
       userData = 'action_type='+type+'&id='+id;
   }
   $.ajax({
       type: 'POST',
       url: 'userAction.php',
       data: userData,
        success:function(msg){
            if(msg == 'ok'){
                alert('User data has been '+statusArr[type]+' successfully.');
                searchUsers($('#searchInput').val(), $('#searchCol').val(), $('#sortCol').val(), $('#limit').val(), $('#sort').val());
                $('.form')[0].reset();
                $('.formData').slideUp();
                $('#tbl_setting').slideUp();
            }else{
                alert('Some problem occurred, please try again.');
            }
        }
    });
}


function editUser(id){
    $('#addForm').slideUp();
    $('#tbl_setting').slideUp();
    $.ajax({
        type: 'POST',
        dataType:'JSON',
        url: 'userAction.php',
        data: 'action_type=data&id='+id,
        success:function(data){
            $('#idEdit').val(data.id);
            $('#idEditText').val(data.id);
            $('#controlEdit').val(data.control);
            $('#nicknameEdit').val(data.nickname);
            $('#nameEdit').val(data.name);
            $('#addressEdit').val(data.address);
            $('#schoolEdit').val(data.school);
            $('#genderEdit').val(data.gender);
            $('#birthdayEdit').val(data.birthday);
            $('#contactEdit').val(data.contact);
            $('#guardianEdit').val(data.guardian);
            $('#econtactEdit').val(data.econtact);
            $('#facilityEdit').val(data.facility);
            $('#departmentEdit').val(data.department);
            $('#supervisorEdit').val(data.supervisor);
            $('#designationEdit').val(data.designation);
            $('#slapdEdit').val(data.slapd);
            $('#apdtitleEdit').val(data.apdtitle);
            $('#hoursEdit').val(data.hours);
            $('#validityEdit').val(data.validity);
            $('#interviewEdit').val(data.interview);
            $('#startedEdit').val(data.started);
            $('#endEdit').val(data.end);


            if(data.filelocation == 'image/'){
              $('#imageEdit').attr('src', 'blank.jpg');
            }else{
              $('#imageEdit').attr('src', data.filelocation);
            }

            // $('#editFile').val(data.filename);
            $('#editForm').slideDown();
        }
    });
}

function openform() {
    window.open("http://localhost/acore/modify", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
}

</script>

</head>
<body>
<div class="container">

    <h3>OJT Database</h3>
    <!-- <div class="loading-overlay" style="display: none;"><div class="overlay-content">Loading.....</div></div> -->

    <div class="row">

        <hr>

    <!-- Search -->
            <div class="form-inline">
                <input type="hidden" id="sort" value="ASC">
                <input type="hidden" id="sortCol" value="id">
                
                &nbsp; 
                <div class="btn-group">
                      <button type="button" name="btn_delete" id="btn_delete" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                      <!-- <button type="button" name="refresh" id="refresh" class="btn btn-info" onclick="location.reload();"><span class="glyphicon glyphicon-refresh"></span></button> -->
                      <!-- <button type="button" name="new_windows" id="new_windows" class="btn btn-primary" onclick="openform();"><span class="glyphicon glyphicon-new-window"></span></button> -->
                      <button type="button" name="create_excel" id="create_excel" class="btn btn-success"><span class="glyphicon glyphicon-export"></span></button>
                </div>
                &nbsp; &nbsp; &nbsp;

                
                <label for="limit">Show entries:</label>
                <div class="form-group">
                    <select class="form-control" id="limit" onchange="searchUsers($('#searchInput').val(), $('#searchCol').val(), $('#sortCol').val(), $('#limit').val(), $('#sort').val())">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                &nbsp; &nbsp; &nbsp;
        
                <!-- Sort:
                <div class="form-group">
                    <select class="form-control" id="sortCol" onchange="searchUsers($('#searchInput').val(), $('#searchCol').val(), $('#sortCol').val(), $('#limit').val())">
                        <option value="name">Name</option>
                        <option value="email">Email</option>
                        <option value="phone">Phone</option>
                        <option value="status">Status</option>
                    </select>
                </div> -->
                
                <label for="searchCol">Column:</label>
                <div class="form-group">
                    <select class="form-control" id="searchCol" onclick="searchUsers($('#searchInput').val(), $('#searchCol').val(), $('#sortCol').val(), $('#limit').val(), $('#sort').val())">
                      <option value="all">All</option>
                      <option value="id">id</option>
                      <option value="control">control</option>
                      <option value="nickname">nickname</option>
                      <option value="name">name</option>
                      <option value="address">address</option>
                      <option value="school">school</option>
                      <option value="gender">gender</option>
                      <option value="birthday">birthday</option>
                      <option value="contact">contact</option>
                      <option value="guardian">guardian</option>
                      <option value="econtact">econtact</option>
                      <option value="department">department</option>
                      <option value="supervisor">supervisor</option>
                      <option value="designation">designation</option>
                      <option value="slapd">slapd</option>
                      <option value="apdtitle">apdtitle</option>
                      <option value="hours">hours</option>
                      <option value="validity">validity</option>
                      <option value="interview">interview</option>
                      <option value="started">started</option>
                      <option value="end">end</option>
                    </select>
                </div>


                <div class="input-group pull-right">
                    <div class="form-group">
                        <input placeholder="search" type="text" class="search form-control" id="searchInput" onchange="searchUsers($('#searchInput').val(), $('#searchCol').val(), $('#sortCol').val(), $('#limit').val(), $('#sort').val())">
                    </div>
                    <span class="input-group-btn">
                        <!-- <input type="button" class="btn btn-primary" value="Search" onclick="searchUsers($('#searchInput').val(), $('#searchCol').val(), $('#sortCol').val(), $('#limit').val(), $('#sort').val())"/> -->
                        <button class="btn btn-primary" onclick="searchUsers($('#searchInput').val(), $('#searchCol').val(), $('#sortCol').val(), $('#limit').val(), $('#sort').val())"><i class="glyphicon glyphicon-search"></i></button>
                    </span>
                </div>
            </div>    
    <!-- EndSearch -->
        <br>
        <div class="panel panel-default users-content">
            <div class="panel-heading">Users 
                <a href="javascript:void(0);" class="glyphicon glyphicon-plus" id="addLink" onclick="javascript:$('#addForm').slideToggle(); $('#editForm').slideUp(); $('#tbl_setting').slideUp();"></a> 
                <a href="javascript:void(0);" class="glyphicon glyphicon-cog" id="addLink" onclick="javascript:$('#tbl_setting').slideToggle();">&nbsp;</a>
            </div>
            
        <!-- Add Form -->
            <div class="panel-body none formData" id="tbl_setting">
                <div class="checkbox">
                    <div class="row">
                        <label class="col-md-1">
                            <input type="checkbox" value="" class="check_box" name="action" checked>
                            Action
                        </label>
                        <label class="col-md-1">
                            <input type="checkbox" value="" class="check_box" name="photo" checked>
                            Photo
                        </label>
                        <label class="col-md-1">
                            <input type="checkbox" value="" class="check_box" name="nickname" checked>
                            Nickname
                        </label>
                        <label class="col-md-1">
                            <input type="checkbox" value="" class="check_box" name="address" checked>
                            Address
                        </label>
                        <label class="col-md-1">
                            <input type="checkbox" value="" class="check_box" name="contact" checked>
                            Contact no.
                        </label>
                        <label class="col-md-1">
                            <input type="checkbox" value="" class="check_box" name="school" checked>
                            School
                        </label>
                        <label class="col-md-1">
                            <input type="checkbox" value="" class="check_box" name="gender" checked>
                            Gender
                        </label>
                        <label class="col-md-1">
                            <input type="checkbox" value="" class="check_box" name="birthday" checked>
                            Birthday
                        </label>
                        <label class="col-md-1">
                            <input type="checkbox" value="" class="check_box" name="guardian" checked>
                            Guardian
                        </label>
                        <label class="col-md-1">
                            <input type="checkbox" value="" class="check_box" name="gcontact" checked>
                            G. contact no.
                        </label>
                        <label class="col-md-1">
                            <input type="checkbox" value="" class="check_box" name="facility" checked>
                            Facility
                        </label>
                        <label class="col-md-1">
                            <input type="checkbox" value="" class="check_box" name="department" checked>
                            Department
                        </label>
                    </div>
                    <div class="row">
                        <label class="col-md-1">
                            <input type="checkbox" value="" class="check_box" name="supervisor" checked>
                            Supervisor
                        </label>
                        <label class="col-md-1">
                            <input type="checkbox" value="" class="check_box" name="designation" checked>
                            Designation
                        </label>
                        <label class="col-md-1">
                            <input type="checkbox" value="" class="check_box" name="slapd" checked>
                            SLAPD
                        </label>
                        <label class="col-md-1">
                            <input type="checkbox" value="" class="check_box" name="apdtitle" checked>
                            APD Title
                        </label>
                        <label class="col-md-1">
                            <input type="checkbox" value="" class="check_box" name="hours" checked>
                            Hours
                        </label>
                        <label class="col-md-1">
                            <input type="checkbox" value="" class="check_box" name="validity" checked>
                            Validity
                        </label>
                        <label class="col-md-1">
                            <input type="checkbox" value="" class="check_box" name="interview" checked>
                            Interview
                        </label>
                        <label class="col-md-1">
                            <input type="checkbox" value="" class="check_box" name="start" checked>
                            Start
                        </label>
                        <label class="col-md-1">
                            <input type="checkbox" value="" class="check_box" name="end" checked>
                            End
                        </label>
                        <label class="col-md-1">
                            <!-- <input type="checkbox" value="" class="check_box" name="" checked>
                            Checkbox -->
                        </label>
<!--                         <label class="col-md-1">
                            <input type="checkbox" value="" class="check_box" name="" checked>
                            Checkbox
                        </label> -->
                       <!--  <label class="col-md-1">
                            <input type="checkbox" value="" class="check_box" name="" checked>
                            Checkbox
                        </label>-->               
                         <label class="col-md-2">
                            <input type="checkbox" value="" class="check_box" name="select_all" id="select_all" checked>
                            Toggle Columns
                        </label>
                    </div>
                    
                </div>
            </div>

             <!-- Add Form -->
            <!-- <div class="panel-body none formData" id="addForm">
                <h2 id="actionLabel">Add User</h2>
                <form class="form" id="userForm" enctype="multipart/form-data" action="" method="POST">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" id="name"/>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" id="email"/>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone"/>
                            </div>
                            <a href="javascript:void(0);" class="btn btn-warning" onclick="$('#addForm').slideUp(), $('#addFile').val(''), $('#imageAdd').attr('src', 'blank.jpg')">Cancel</a> -->
                            <!-- <a href="javascript:void(0);" class="btn btn-success" onclick="userAction('add')">Add User</a> -->
                            <!-- <a href="#" class="btn btn-success" id="shitButton">Add User</a> -->
                            <!-- <input type="hidden" name="action_type" id="action_type" value="add">
                            <input type="submit" id="addSubmit" name="addSubmit" value="Add User" class="btn btn-success">

                        </div>
                        <div class="col-md-3">
                            <a href="#" class="thumbnail" id="addThumbnail">
                                <img alt="" src="blank.jpg" width="450" height="300" id="imageAdd">
                            </a>
                            <input type="file" name="addFile" id="addFile" onchange="addFilePreview(this)" />
                        </div>
                    </div>
                </form>
            </div> -->
            

            <?php include 'addForm.php';?>
        <!-- End Add Form -->

        <!-- Edit Form -->
           <!--  <div class="panel-body none formData" id="editForm">
                <h2 id="actionLabel">Edit User</h2>
                <form class="form" id="userForm" enctype="multipart/form-data" action="" method="POST">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" id="nameEdit"/>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" id="emailEdit"/>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone" id="phoneEdit"/>
                            </div>
                            <input type="hidden" class="form-control" name="id" id="idEdit"/>
                            <a href="javascript:void(0);" class="btn btn-warning" onclick="$('#editForm').slideUp(), $('#editFile').val('')">Cancel</a> -->
                            <!-- <a href="javascript:void(0);" class="btn btn-success" onclick="userAction('edit')">Update User</a> -->
                            <!-- <input type="hidden" name="action_type" id="action_type" value="edit"> -->
                            <!-- <input type="submit" id="editSubmit" name="editSubmit" value="Update User" class="btn btn-success">
                        </div>
                        <div class="col-md-3">
                            <a href="#" class="thumbnail" id="editThumbnail">
                                <img alt="" src="blank.jpg" width="450" height="300" id="imageEdit">
                            </a>
                            <input type="file" name="editFile" id="editFile" onchange="editFilePreview(this)"/>
                        </div>
                    </div>
                </form>
            </div> -->
            <?php include 'editForm.php';?>
        <!-- End Edit Form -->
        
            
            <div id="displayData" style="overflow-x: auto; height: auto; max-height: 592px"></div>

        </div>
        <div id="pages"></div> 
        <hr>

        <div class="btn-group">
            <button type="button" class="btn btn-danger" onclick="$('#card').empty()"><span class="glyphicon glyphicon-remove-sign"></span></button>
            <button type="button" name="btn_card" id="btn_card" class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span></button>
            <button type="button" class="btn btn-primary" onclick="printPageArea('card')"><span class="glyphicon glyphicon-print"></span></button>
        </div>
        <br><br>
        <center><div id="card" style="overflow-x: auto; height: auto; max-height: 420px; width: 1055px;"></div></center>

    </div>

    <hr>
    <div class="row">
        <div class="col-lg-12">
            <ul class="nav nav-pills nav-justified">
                <li><a href="#"><span>© 2016 JEFFREY B. BALMES</span></a></li>
                <!-- <li><a href="#">Terms of Service</a></li> -->
                <!-- <li><a href="#">Privacy</a></li> -->
            </ul>
        </div>
    </div>
</div>
</body>
</html>