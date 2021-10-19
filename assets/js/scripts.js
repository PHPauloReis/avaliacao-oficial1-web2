function deleteEmployee(event, id) {
    event.preventDefault()

    const userConfirmation = confirm("Você tem certeza que deseja remover este registro? Essa operação não poderá ser desfeita!")

    if (userConfirmation) {
        window.location = `delete.php?id=${id}`
    }
}
