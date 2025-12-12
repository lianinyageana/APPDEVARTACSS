function updateProgress(step, total) {
  const fill = document.querySelector('.fill');
  const label = document.querySelector('.progress span');
  const percent = (step / total) * 100;
  fill.style.width = percent + '%';
  label.textContent = `${step}/${total}`;
}