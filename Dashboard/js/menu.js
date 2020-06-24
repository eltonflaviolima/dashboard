let iconMenu = document.getElementById('iconMenu');
let sidebar = document.getElementById('sidebar');
let main = document.getElementById('mainContent');

let w = window.innerWidth;

window.addEventListener("resize", ()=> {
    w = window.innerWidth;
})
function responsiveSidebar () {
    if(w <= 768){
        if(sidebar.style.display == 'none') {
            sidebar.style.display = 'block';
        }else{
            sidebar.style.display = 'none';
            main.style.width = '100%';
        }
    }else{
        if(sidebar.style.display == 'none') {
            sidebar.style.display = 'block';
            main.style.width = 'calc(100% - 300px)';
        }else{
            sidebar.style.display = 'none';
            main.style.width = '100%';
        }
    }
}