document.addEventListener('DOMContentLoaded', () => {
    const badges = document.querySelectorAll('[data-highlight-target]');
    const cards = document.querySelectorAll('.mission-card');

    const removeActive = () => {
        badges.forEach((badge) => badge.classList.remove('is-active'));
        cards.forEach((card) => card.classList.remove('is-active'));
    };

    badges.forEach((badge, index) => {
        badge.addEventListener('click', () => {
            const targetId = badge.dataset.highlightTarget;
            const targetCard = document.getElementById(targetId);

            if (!targetCard) return;

            removeActive();
            targetCard.classList.add('is-active');
            badge.classList.add('is-active');

            targetCard.scrollIntoView({
                behavior: 'smooth',
                block: index === 0 ? 'center' : 'nearest'
            });
        });
    });
});
