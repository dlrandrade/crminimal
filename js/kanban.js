const draggables = document.querySelectorAll('.card');
const columns = document.querySelectorAll('.column');

draggables.forEach(card => {
  card.addEventListener('dragstart', () => card.classList.add('dragging'));
  card.addEventListener('dragend', () => {
    card.classList.remove('dragging');
    save(card);
  });
});

columns.forEach(column => {
  column.addEventListener('dragover', e => {
    e.preventDefault();
    const dragging = document.querySelector('.dragging');
    column.appendChild(dragging);
  });
});

function save(card){
  const id = card.dataset.id;
  const stage = card.parentElement.dataset.stage;
  fetch('php/oportunidades.php', {
    method:'POST',
    headers:{'Content-Type':'application/x-www-form-urlencoded'},
    body:`id=${id}&stage=${stage}`
  });
}
