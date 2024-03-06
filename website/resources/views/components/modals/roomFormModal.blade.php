<div class="hidden" id="addNewRoomFormModal">
    <div class="absolute top-0 left-0 h-screen w-full opacity-50 bg-black">
    </div>
    <div class="absolute top-0 left-0 h-screen w-full flex justify-center self-center">
        <div class=" w-1/3 h-auto self-center p-3 relative">
            <div class="w-full h-full bg-white rounded-lg p-3">
                <form id="createRoomForm" class=" w-full h-full font-semibold  ">
                    @csrf
                    <h3 class="w-full text-center text-lg">Create new Form</h3>
                    <div class="w-full text-lg">
                        <label for="room_name" class="block text-sm leading-6 text-gray-600">Room Name:</label>
                        <input type="text"
                               name="room_name"
                               required
                               id="room_name"
                               autocomplete="room_name"
                               class="w-full text-sm  rounded-lg border border-gray-400 mt-1 focus:outline-blue-600 focus: font-light p-2"
                               placeholder="Type room name"
                               autofocus >

                    </div>
                    <div class="w-full text-lg">
                        <label for="room_icon" class="block text-sm leading-6 text-gray-600">Room Icon:</label>
                        <input type="text"
                               name="room_icon"
                               id="room_icon"
                               autocomplete="room_icon"
                               class="w-full text-sm  rounded-lg border border-gray-400 mt-1 focus:outline-blue-600 focus: font-light p-2"
                               placeholder="Type room name"
                               autofocus
                        >
                    </div>
                    <div class="w-full text-lg">
                        <label for="room_description" class="block text-sm leading-6 text-gray-600">Room Description:</label>
                        <textarea type="text"
                                  name="room_description"
                                  id="room_description"
                                  autocomplete="room_description"
                                  class="w-full text-sm  rounded-lg border border-gray-400 mt-1  focus:outline-blue-600 focus: font-light p-2"
                                  placeholder="Type room name"
                                  rows="3"
                                  autofocus
                        ></textarea>

                    </div>
                    <div class="w-full mt-3 ">
                        <div class="flex justify-end items-center gap-2">
                            <button type="button" onclick="closeModal('addNewRoomFormModal')" class="bg-gray-500 border border-gray-500 text-gray-50 py-2 px-4 rounded-lg hover:bg-white hover:text-gray-500 ">
                                Cancel
                            </button>
                            <button type="submit" class="bg-blue-500 border border-blue-500 text-gray-50 py-2 px-4 rounded-lg hover:bg-white hover:text-blue-600">
                                Create
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <button onclick="closeModal('addNewRoomFormModal')" class="absolute top-0 right-0 border border-gray-600 bg-gray-300 w-8 h-8 rounded-full text-red-500 hover:text-white hover:bg-red-500" >
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>

</div>
