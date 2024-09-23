import './bootstrap';

Echo.private('notification')
    .listen('UserSessionChanged', (e)=> {
        const notiElement=document.getElementById('notification')
        notiElement.innerText=e.message
        notiElement.classList.remove('invisible')
        notiElement.classList.remove('alert-danger')
        notiElement.classList.remove('alert-success')
        notiElement.classList.add('alert-'+e.type)
    })
