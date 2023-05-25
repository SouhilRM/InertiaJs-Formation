export function sweetAlert(type, message){
    Swal.fire({
        toast: true,
        icon: type,
        title: message,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
    })
}

export function sweetConfirm(message, callback){
    Swal.fire({

            title: message,
            icon: 'warning',
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