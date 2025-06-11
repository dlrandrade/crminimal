function makeDraggable(card){
  card.addEventListener('dragstart', () => card.classList.add('dragging'));
  card.addEventListener('dragend', () => {
    card.classList.remove('dragging');
    save(card);
  });
}

function initDrag(){
  document.querySelectorAll('.card').forEach(makeDraggable);
}

document.addEventListener('dragover', e => {
  const column = e.target.closest('.column');
  if(!column) return;
  e.preventDefault();
  const dragging = document.querySelector('.dragging');
  if(dragging && column!==dragging.parentElement){
    column.appendChild(dragging);
  }
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
