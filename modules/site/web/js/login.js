$(document).ready(function () {
    $('#show_password').on('click', function () {
        var $input = $(this).closest('div').find('input');

        $(this).toggleClass('fa-eye-slash').toggleClass('fa-eye');

        if ( $input.attr('type') === 'password' ) {
            $input.attr('type', 'text');
        } else {
            $input.attr('type', 'password');
        }
    });
});

// var canPromise = !!window.Promise;
// if(canPromise) {
//     cadesplugin.then(function () {
//             // Создание объектов КриптоПро ЭЦП Browser plug-in
//             var oStore =  cadesplugin.CreateObjectAsync("CAdESCOM.Store");
//
//             oStore.then(function(data) {
//                 data.Open();
//
//                 data.Certificates.then(function (res) {
//                     for (var i = 1; i <= 3; i++) {
//                         res.Item(i).then(function (cert) {
//                             cert.IssuerName.then(function (name) {
//                                 console.log(name)
//                             })
//                         })
//                     }
//                 })
//             });
//         },
//         function(error) {
//             console.log(error)
//         }
//     );
// } else {
//     window.addEventListener("message", function (event){
//             if (event.data == "cadesplugin_loaded") {
//                 console.log('cadesplugin_loaded')
//             } else if(event.data == "cadesplugin_load_error") {
//                 console.log('cadesplugin_load_error')
//             }
//         },
//         false);
//     window.postMessage("cadesplugin_echo_request", "*");
// }
