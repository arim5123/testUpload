
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

function Intro_State_chg(num){
    $.ajax({
        type:"post",
        url:'/admin/intro/state_modify/'+num,
        processData: false,
        contentType: false,
        cache: false,
        success:function(rs){
            if(rs === "success"){
                Swal.fire({title : '변경되었습니다.', icon: 'success'}).then((result) => { location.reload(); });
            }else{
                Swal.fire({title : '다시 시도해주세요.', icon: 'error'});
            }
        }
    });
}

function Intro_Delete_Swal(num) {
    $.ajax({
        type:"post",
        url:'/admin/intro/delete/'+num,
        processData: false,
        contentType: false,
        cache: false,
        success:function(rs){
            if(rs === "success"){
                Swal.fire({title : '삭제되었습니다.', icon: 'success'}).then((result) => { location.reload(); });
            }else{
                Swal.fire({title : '다시 시도해주세요.', icon: 'error'});
            }
        }
    });
}
