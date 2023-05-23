export function sweetAlert(type, message){
    Swal.fire({
        toast: true,
        icon: type,
        title: message,
        //animation: false,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
    })
}

export function sweetConfirm(message, callback){
    Swal.fire({

            title: message,

            //text: "You won't be able to revert this!",

            icon: 'warning',

            //buttonStyling: true,

            showCancelButton: true,

            confirmButtonText: 'Oui, Confirmer.',

            cancelButtonText: 'Non, Fermer.',

            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            
        }).then((result) => {
            if (result.isConfirmed) {
                callback();
            }
            else if(result.isDenied){
                Swal.close();
            }
        })
}