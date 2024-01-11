document
  .getElementById('authorForm')
  .addEventListener('submit', function (event) {
    console.log('submit')
    event.preventDefault()

    // Получение данных из формы
    
    const form = document.getElementById('authorForm');
    const authorId = form.getAttribute('data-author-id');


    const formData = new FormData(form);
    formData.append('authorId',authorId)

    const image = formData.get('image')
    if(!image.size){
        formData.delete('image')
    }

    // Отправляем данные формы на сервер
    fetch('http://localhost/admin/authors/edit', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Обработка ответа от сервера, например, обновление интерфейса
        alert(data.message)
    })
    .catch(error => {
      alert(error.message)
    });
  })
