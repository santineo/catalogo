$('.js_productsFilterForms').find('select').on('change', (e) => {
  $(e.currentTarget).closest('.js_productsFilterForms').trigger('submit');
});
