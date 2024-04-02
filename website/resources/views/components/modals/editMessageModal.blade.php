@foreach($messages as $message)
    <div class="hidden z-50" id="editMessageModal{{$message->id}}">
        <div class="fixed top-0 left-0 w-full h-full flex z-50 items-center justify-center bg-black bg-opacity-50 ">
            <div class="bg-white rounded-lg shadow-lg w-2/3 ">
                <div class="flex justify-between items-center  px-4 py-2 bg-gray-100 rounded-t-lg">
                    <h3 class="text-lg font-semibold text-gray-800">Edit Message</h3>
                    <button type="button" onclick="closeModal('editMessageModal{{$message->id}}')" class="text-gray-600 hover:text-gray-800">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                            <path d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-4">
                    <form id="editMessageForm" action="{{ route('room.edit-message', ['id' => $message->id]) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="message_content" class="block text-sm font-medium text-gray-700">Message Content:</label>
                            <textarea type="text" name="message_content" id="message_content" rows="4" class="border-2 text-gray-900 border-solid w-full mt-1 border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                {{$message->content}}
                            </textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="button" onclick="closeModal('editMessageModal{{$message->id}}')" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 border border-gray-300 rounded-md hover:bg-gray-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500">
                                Cancel
                            </button>
                            <button type="submit" class="ml-3 inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-500 border border-transparent rounded-md hover:bg-blue-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endforeach
