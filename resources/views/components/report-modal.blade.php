@props(['questionId'])

<div id="report-modal" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-500/30 transition-opacity">
    <div class="relative w-full max-w-md md:max-w-xl p-4">
        <div class="relative bg-white rounded-lg shadow-xl">
            <div class="flex items-center justify-between p-5 border-b border-gray-100">
                <h3 class="text-xl font-semibold text-gray-800">
                    Laporkan Soal
                </h3>
                <button type="button" data-modal-toggle="report-modal"
                    class="text-gray-400 bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg p-1.5 ml-auto inline-flex items-center hover:cursor-pointer">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <form method="POST" action="{{ route('soal.lapor', $questionId) }}" class="p-6 space-y-6">
                @csrf
                @method('POST')
                <div>
                    <label for="laporan" class="block mb-2 text-sm font-medium text-gray-700">Keterangan</label>
                    <textarea id="laporan" rows="5" name="laporan"
                        class="block w-full px-4 py-3 text-sm text-gray-700 placeholder-gray-400 bg-gray-50 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Tuliskan alasan pelaporan atau kesalahan yang ditemukan..."></textarea>
                </div>
                <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                    <button type="submit"
                        class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 hover:cursor-pointer rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                        Kirim Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>