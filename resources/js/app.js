import '../css/app.css';

window.addEventListener('mousemove', (e) => {

    const x = e.clientX / window.innerWidth;
    const y = e.clientY / window.innerHeight;

    document.body.style.backgroundPosition = `${x * 30}px ${y * 30}px`;

});
