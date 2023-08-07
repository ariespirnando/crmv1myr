function login_failure1(){
    Snackbar.show({
        text: 'Data Tidak Lengkap',
        actionTextColor: '#fff',
        backgroundColor: '#e7515a',
        pos: 'top-right'
    }); 
    clear_text();
}
function login_failure2(){
    Snackbar.show({
        text: 'Login Gagal',
        actionTextColor: '#fff',
        backgroundColor: '#e7515a',
        pos: 'top-right'
    }); 
    clear_text();
}

function login_failure3(){
    Snackbar.show({
        text: 'Captcha Tidak Valid',
        actionTextColor: '#fff',
        backgroundColor: '#e7515a',
        pos: 'top-right'
    }); 
    clear_text(); 
}

function login_failure4(){
    Snackbar.show({
        text: 'Captcha Belum Diisi',
        actionTextColor: '#fff',
        backgroundColor: '#e7515a',
        pos: 'top-right'
    });  
}

function login_failure5(){
    Snackbar.show({
        text: 'Format Email Tidak Sesuai',
        actionTextColor: '#fff',
        backgroundColor: '#e7515a',
        pos: 'top-right'
    });  
}

function login_failure6(){
    Snackbar.show({
        text: 'Terjadi Kesalahan',
        actionTextColor: '#fff',
        backgroundColor: '#e7515a',
        pos: 'top-right'
    });  
}

function login_failure7(){
    Snackbar.show({
        text: 'Email sudah terdaftar, gunakan email lain',
        actionTextColor: '#fff',
        backgroundColor: '#e7515a',
        pos: 'top-right'
    });  
}

function login_failure8(){
    Snackbar.show({
        text: 'Email tidak ditemukan',
        actionTextColor: '#fff',
        backgroundColor: '#e7515a',
        pos: 'top-right'
    });  
}

function login_failure9(){
    Snackbar.show({
        text: 'Email sudah terkirim, silahkan cek email anda',
        actionTextColor: '#fff',
        backgroundColor: '#314EF5',
        pos: 'top-right'
    });  
}

function clear_text(){
    $('#password').val("");
    $('#username').val("");
    $('#captca').val(""); 
}

function reload(time){
    var block = $('.a-u-reload');
    $(block).block({
        message: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>',
        timeout: time, //unblock after 2 seconds
        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.8,
            cursor: 'wait'
        },
        css: {
            border: 0,
            padding: 0,
            backgroundColor: 'transparent'
        }
    });
}