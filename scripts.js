document.querySelector('.themes').addEventListener('chang', (event)=>{
    if (event.target.nodeName === 'IMPUT') {
        document.documentElement.classList.remove('dark', 'light');
        document.documentElement.classList.add(event.target.value);
    }
})