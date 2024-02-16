@extends('layouts.app')

@section('content')
@include('components.header') 
<div class="container w-full h-full">
    <div style="padding:30px;">
        <h1 class="text-2xl font-bold">Bienvenido a LikeSMS</h1>
        
        <div class="flex justify-between items-center">
            <h1 class="">Archivos disponibles</h1>
            <!-- Modal toggle -->
            <button data-modal-target="static-modal" data-modal-toggle="static-modal" class="block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
            Subir archivo CSV
            </button>

            <div id="static-modal"  tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Subir archivo CSV
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5 space-y-4">
                           
                            <form action="{{ route('csv.upload') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="flex">
                                <div class="mb-4 mr-4">
                                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Título
                                    </label>
                                    <input type="text" name="name" id="name" class="mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300 dark:border-gray-600 dark:bg-gray-700 dark:focus:border-blue-300" required maxlength="100">
                                </div>

                                <div class="mb-4">
                                    <label for="csv_file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Selecciona el archivo con formato <b>CSV</b> 
                                    </label>
                                    <input type="file" name="csv_file" id="csv_file" accept=".csv" class="mt-1  border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300 dark:border-gray-600 dark:bg-gray-700 dark:focus:border-blue-300" required>
                                </div>
                                </div>
                            

                                <div class="flex items-center  border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                        Subir CSV
                                    </button>
                                    <button data-modal-hide="static-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                        Decline
                                    </button>
                                </div>
                            </form>
                        </div>
                
                        
                    </div>
                </div>
            </div>
        </div>
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative my-2" role="alert">
                <strong class="font-bold">¡Éxito!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    
                </span>
            </div>
        @endif
        <table class="min-w-full divide-y divide-gray-200 mt-10">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total de registros</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Creado por</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Opciones</th>
                    <!-- Agrega más encabezados según sea necesario -->
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($csvs as $csv)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $csv->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ isset($csv->csvData)? count($csv->csvData): 0 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{  $csv->user->name . '  '. $csv->created_at->format('d-m-Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap flex">


                            <button data-modal-target="view-modal-{{$csv->id}}" data-modal-toggle="view-modal-{{$csv->id}}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                Ver registros
                            </button>

                            <div id="view-modal-{{$csv->id}}"  tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                Registros guardados
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="view-modal-{{$csv->id}}">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5 space-y-4">
                                            <div class="overflow-y-scroll" style="height: 300px;">
                                                <table class="mt-2 min-w-full divide-y divide-gray-200">
                                                    <thead>
                                                        <tr>
                                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($csv->csvData as $data)
                                                            <tr>
                                                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                                                <td class="px-4 py-2">{{ $data->phone }}</td>
                                                                <td class="px-4 py-2">{{ $data->message }}</td>
                                                                <td class="px-4 py-2">{{ $data->status }}</td>
                                                            </tr>
                                                        @endforeach
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                            <h3 class="text-xs font-bold text-gray-700 dark:text-gray-300">¿Agregar mas registros?</h3>
                                            <form action="{{ route('csv.moredata') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="flex">
                                                    <div class="mb-4">
                                                        <input type="text" name="id" id="id" value="{{$csv->id}}" hidden>

                                                        <input type="file" name="csv_file" id="csv_file" accept=".csv" class="mt-1  border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300 dark:border-gray-600 dark:bg-gray-700 dark:focus:border-blue-300" required>
                                                        <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                            Agregar nuevos registros
                                                        </button>
                                                    
                                                    </div>
                                                </div>                                    
                                            </form>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <button data-modal-target="edit-modal-{{$csv->id}}" data-modal-toggle="edit-modal-{{$csv->id}}" class="block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ml-2" type="button">
                                Editar
                            </button>

                            <div id="edit-modal-{{$csv->id}}"  tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                Editar
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-modal-{{$csv->id}}">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5 space-y-4">
                                        
                                            <form action="{{ route('csv.update') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="flex">
                                                    <input type="text" name="id" id="id" value="{{$csv->id}}" hidden>

                                                    <div class="mb-4 mr-4">
                                                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                            Título 
                                                        </label>
                                                        <input type="text" name="name" id="name" value="{{$csv->name}}" class="mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300 dark:border-gray-600 dark:bg-gray-700 dark:focus:border-blue-300" required maxlength="100">
                                                    </div>

                                              
                                                </div>
                                            

                                                <div class="flex items-center  border-t border-gray-200 rounded-b dark:border-gray-600">
                                                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                        Actualizar
                                                    </button>
                                                    <button data-modal-hide="edit-modal-{{$csv->id}}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                        Cancelar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <button data-modal-target="delete-modal-{{$csv->id}}" data-modal-toggle="delete-modal-{{$csv->id}}" class="block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ml-2" type="button">
                                Eliminar
                            </button>

                            <div id="delete-modal-{{$csv->id}}"  tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                Eliminar
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="delete-modal-{{$csv->id}}">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5 space-y-4">
                                            <h3 class="font-bold">¿Desea eliminar el registro?</h3>
                                            <p>Los datos asociados será eliminados y no podrán recuperarse</p>
                                            <form action="{{ route('csv.delete') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="flex">
                                                    <input type="text" name="id" id="id" value="{{$csv->id}}" hidden>
                                                </div>
                                            
                                                <div class="flex items-center  border-t border-gray-200 rounded-b dark:border-gray-600">
                                                    <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                        Si eliminar
                                                    </button>
                                                    <button data-modal-hide="delete-modal-{{$csv->id}}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                        Cancelar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $csvs->links() }}   
    
</div>
@endsection