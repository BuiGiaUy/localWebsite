<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="notificationModal">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white w-1/3 rounded-lg shadow-lg">
            <div class="modal-header px-4 py-2 bg-gray-800 text-white rounded-t-lg">
                <h5 class="text-lg font-semibold">Notification</h5>
                <button onclick="closeNotificationModal()" class="text-white">&times;</button>
            </div>
            <div class="modal-body px-4 py-2">
                <!-- Notification content will be displayed here -->
                <p id="notificationContent"></p>
            </div>
            <div class="modal-footer px-4 py-2 bg-gray-800 text-right rounded-b-lg">
                <button onclick="closeNotificationModal()" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Close</button>
            </div>
        </div>
    </div>
</div>
