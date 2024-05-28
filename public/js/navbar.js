let navbar = document.getElementById('navbar') ;

window.addEventListener('scroll' , ()=>{
    if(window.scrollY >= 56 ){
        navbar.classList.add('navbar-scroll');
    }else{
        navbar.classList.remove('navbar-scroll');
    }
})