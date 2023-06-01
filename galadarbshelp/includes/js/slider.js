function revealOnScroll(selector) {
    const elements = document.querySelectorAll(selector);

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.intersectionRatio > 0) {
                entry.target.classList.add('opacity-100', 'translate-y-0');
                observer.unobserve(entry.target);
            }
        });
    });

    elements.forEach(element => {
        element.style.transition = "opacity 1s ease-out, transform 1s ease-out";
        observer.observe(element);
    });
}