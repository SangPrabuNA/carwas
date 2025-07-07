<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car - CarWash</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style> body { font-family: 'Poppins', sans-serif; background-color: #f3f4f6; } </style>
</head>
<body>
    <main class="container mx-auto px-6 py-12">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Edit Car</h1>

        <div class="bg-white p-8 rounded-lg shadow-xl max-w-2xl mx-auto">
            <form action="{{ route('cars.update', $car) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PATCH')

                <div>
                    <label for="plate_number" class="block text-sm font-medium text-gray-700">Plate Number</label>
                    <input type="text" id="plate_number" name="plate_number" value="{{ old('plate_number', $car->plate_number) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3">
                </div>

                <div>
                    <label for="brand" class="block text-sm font-medium text-gray-700">Brand</label>
                    <input type="text" id="brand" name="brand" value="{{ old('brand', $car->brand) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3">
                </div>

                <div>
                    <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
                    <input type="text" id="model" name="model" value="{{ old('model', $car->model) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3">
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">New Car Photo (Optional)</label>
                    <input type="file" id="image" name="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    @if ($car->image)
                        <p class="text-xs text-gray-500 mt-2">Current image: <img src="{{ asset('storage/' . $car->image) }}" class="inline-block h-10 w-auto ml-2"></p>
                    @endif
                </div>

                <div class="flex justify-end pt-6 space-x-3">
                    <a href="{{ route('profile.edit') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-lg">Cancel</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg">Update Car</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>