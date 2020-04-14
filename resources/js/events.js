document.addEventListener('form_changed', () => {
  window.onbeforeunload = () => {
    return '¿Esta seguro de irse sin guardar los cambios?';
  };
});

document.addEventListener('form_saved', () => {
  window.onbeforeunload = () => {};
});
