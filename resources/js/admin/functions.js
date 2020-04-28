window.GlobalFunctions = {};

GlobalFunctions.addCategory = (name, callback) => {
  const response = axios.post('/administracion/categorias', { name }).then((response) => {
    callback({
      value: response.data.category.id,
      text: response.data.category.name
    });
  })
  .catch((err) => {
    callback(false);
  });

};

GlobalFunctions.addBrand = async (name, callback) => {
  const response = axios.post('/administracion/marcas', { name }).then((response) => {
    callback({
      value: response.data.brand.id,
      text: response.data.brand.name
    });
  })
  .catch((err) => {
    callback(false);
  });

};
