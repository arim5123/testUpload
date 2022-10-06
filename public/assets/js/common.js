
function Change_pw_Swal() {
    var form = $('#pw_info')[0];
    var data = new FormData(form);
    $.ajax({
        type:"post",
        url:'/admin/login/pw_change',
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success:function(rs){
            console.log(rs);
            if(rs === "success"){
                Swal.fire({title : '변경되었습니다.',text:'변경된 비밀번호로 다시 로그인해주세요.', icon: 'success'}).then((result) => { location.replace('/admin/login'); });
            }else{
                Swal.fire({title : '다시 시도해주세요.', icon: 'error'});
            }
        }
    });
}

function changeTimeSetting(val) {
    $.ajax({
        type: "POST",
        url: "/admin/main/time_setting",
        data: {time_set:val},
        async : true,
        success:function(rs){
            if(rs === "success"){
                Swal.fire({title : '변경되었습니다.', icon: 'success'}).then((result) => { location.replace('/admin/main'); });
            }else{
                Swal.fire({title : '실패', html: '다시 시도해 주세요.' ,icon: 'error'});
            }
        }
    });
}

//인트로 출력 순서 변경
function myFunction(val) {
    $.ajax({
        type: "POST",
        url: "/admin/intro/ajaxData",
        data: val,
        async : true,
        success:function(rs){
            if(rs === "success"){
                Swal.fire({title : '변경되었습니다.', icon: 'success'}).then((result) => { location.replace('/admin/intro/'); });
            }else{
                Swal.fire({title : '실패', html: '다시 시도해 주세요.' ,icon: 'error'});
            }
        }
    });
}

//Intro Setting - Table form data
function ModifyFunction_Swal(){
    var form = $('#intro_setting')[0];
    var data = new FormData(form);
    $.ajax({
        type:"post",
        url:'/admin/intro/setting_ajax',
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success:function(rs){
            if(rs ==="success"){
                Swal.fire({title : '수정되었습니다.', icon: 'success'}).then((result) => {location.reload();});
            }else if( rs === "used"){
                Swal.fire({title : '해당 기능을 사용할 수 없습니다.', text:'최소 1개 이상의 게시물을 업로드 후 이용해주세요.', icon: 'error'}).then((result) => {location.replace('/admin/intro');});
            }else{
                Swal.fire({title : '다시 시도해주세요.', icon: 'error'}).then((result) => {location.reload();});
            }
        }
    });
}

function DeleteFunction_Swal(num){
    $.ajax({
        type:"post",
        url:'/admin/intro/delete/'+num,
        data: num,
        processData: false,
        contentType: false,
        cache: false,
        success:function(rs){
            if(rs === "success"){
                Swal.fire({title : '삭제되었습니다.', icon: 'success'}).then((result) => { location.replace('/admin/intro'); });
            }else if( rs === "used"){
                Swal.fire({title : '최소 1개 이상의 </br> 게시글이 필요합니다.', text:'환경설정에서 사용여부를 중지로 변경 후 삭제해주세요.', icon: 'error'}).then((result) => { location.replace('/admin/intro/setting'); });
            }else{
                Swal.fire({title : '삭제가 완료되지 않았습니다.', text:'다시 확인해주세요.', icon: 'error'}).then((result) => { location.replace('/admin/intro'); });
            }
        }
    });
}

function School_Modify_Swal(){
    var form = $('#school_info')[0];
    var data = new FormData(form);

    if(page_val == 1){
        var url = new String("/admin/school/msg");
    }else if(page_val == 2){
        var url = new String("/admin/school/history");
    }else if(page_val == 3){
        var url = new String("/admin/school/info");
    }else{
        var url = new String("/admin/school/song");
    }

    $.ajax({
        type:"post",
        url:'/admin/school/ajax/'+page_val,
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success:function(rs){
            if(rs == 'success'){
                Swal.fire({title : '수정되었습니다.', icon: 'success'}).then((result) => { location.replace(url); });
            }else{
                Swal.fire({title : '다시 시도해주세요.', icon: 'error'}).then((result) => { location.replace(url); });
            }
        }
    });
}

function Count_Modify_Swal(){
    var form = $('#school_info')[0];
    var data = new FormData(form);
    $.ajax({
        type:"post",
        url:'/admin/count/ajax',
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success:function(rs){
            if(rs == 'success'){
                Swal.fire({title : '수정되었습니다.', icon: 'success'}).then((result) => { location.replace('/admin/count'); });
            }else{
                Swal.fire({title : '다시 시도해주세요.', icon: 'error'}).then((result) => { location.replace('/admin/count'); });
            }
        }
    });
}

function Notice_Delete_Swal(num){
    $.ajax({
        type:"post",
        url:'/admin/notice/delete/'+num,
        data: num,
        processData: false,
        contentType: false,
        cache: false,
        success:function(rs){
            if(rs === "success"){
                Swal.fire({title : '삭제되었습니다.', icon: 'success'}).then((result) => { location.replace('/admin/notice'); });
            }else{
                Swal.fire({title : '삭제가 완료되지 않았습니다.', text:'다시 확인해주세요.', icon: 'error'}).then((result) => { location.replace('/admin/notice'); });
            }
        }
    });
}

function Notice_myFunction(val) {
    $.ajax({
        type: "POST",
        url: "/admin/notice/ajaxData",
        data: val,
        async : true,
        success:function(rs){
            if(rs === "success"){
                Swal.fire({title : '변경되었습니다.', icon: 'success'}).then((result) => { location.reload(); });
            }else{
                Swal.fire({title : '실패', html: '다시 시도해 주세요.' ,icon: 'error'});
            }
        }
    });
}

function Gallery_Graduate_Delete_Swal(num){
    $.ajax({
        type:"post",
        url:'/admin/gallery/graduate_delete/'+num,
        data: num,
        processData: false,
        contentType: false,
        cache: false,
        success:function(rs){
            if(rs === "success"){
                Swal.fire({title : '삭제되었습니다.', icon: 'success'}).then((result) => { location.reload();});
            }else{
                Swal.fire({title : '삭제가 완료되지 않았습니다.', text:'다시 확인해주세요.', icon: 'error'}).then((result) => { location.reload(); });
            }
        }
    });
}

function Gallery_History_Delete_Swal(num){
    $.ajax({
        type:"post",
        url:'/admin/gallery/history_delete/'+num,
        data: num,
        processData: false,
        contentType: false,
        cache: false,
        success:function(rs){
            if(rs === "success"){
                Swal.fire({title : '삭제되었습니다.', icon: 'success'}).then((result) => { location.reload();});
            }else{
                Swal.fire({title : '삭제가 완료되지 않았습니다.', text:'다시 확인해주세요.', icon: 'error'}).then((result) => { location.reload(); });
            }
        }
    });
}