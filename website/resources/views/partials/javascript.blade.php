<script>
    function openModal(modal_id){
        console.log(modal_id)
        let addNewRoomFormModal = document.getElementById(modal_id);
        if (addNewRoomFormModal){
            addNewRoomFormModal.classList.remove('hidden');
            addNewRoomFormModal.classList.add('visible');
        }
    }
    // TODO: Close modal by Id
    function closeModal(modal_id){
        console.log("close modal")
        let addNewRoomFormModal = document.getElementById(modal_id);
        addNewRoomFormModal.classList.remove('visible');
        addNewRoomFormModal.classList.add('hidden');
    }
    function turnOnNotification(message, type){
        const notificationElement = document.getElementById('notification-'+type);
        const notificationMessageElement = document.getElementById('notification-'+type+'-message');
        notificationMessageElement.innerText = message;
        notificationElement.classList.remove('hidden');
        notificationElement.classList.add('visible');
        setTimeout(function(){
            notificationElement.classList.remove('visible');
            notificationElement.classList.add('hidden');
        }, 3000);
    }
</script>
