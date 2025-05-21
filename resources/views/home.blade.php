@extends('template.dashboard')

@section('dashboard_content')
  <title>Home - Pertagas</title>
  <style>
    @keyframes float {
      0% {
        transform: translateY(0px);
      }
      50% {
        transform: translateY(-20px);
      }
      100% {
        transform: translateY(0px);
      }
    }

    .float-animation {
      animation: float 6s ease-in-out infinite;
    }

    .text-shadow {
      text-shadow: 4px 4px 8px rgba(0, 0, 0, 0.3);
    }

    @keyframes fadeInSlideUp {
      0% {
        opacity: 0;
        transform: translateY(30px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeInSlideRight {
      0% {
        opacity: 0;
        transform: translateX(-30px);
      }
      100% {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes fadeInScale {
      0% {
        opacity: 0;
        transform: scale(0.9);
      }
      100% {
        opacity: 1;
        transform: scale(1);
      }
    }

  .animate-hello {
    animation: fadeInSlideRight 0.8s ease-out forwards;
  }

  .animate-logo {
    opacity: 0;
    animation: fadeInSlideUp 0.8s ease-out 0.3s forwards;
  }

  .animate-table {
    opacity: 0;
    animation: fadeInScale 0.8s ease-out 0.6s forwards;
  }
  </style>

  <div class="w-full" id="main-content">
    <div class="container mx-auto">
      <div class="flex items-center justify-center min-h-[400px] mb-6">
        <div class="flex flex-row items-center justify-between max-w-4xl w-full">
          <div class="">
            <h1 class="text-[55px] text-white font-extrabold animate-hello text-shadow ml-[-15px]">Hello,<br />{{$user->name}}</h1>
          </div>
          <img src="/assets/pertamina.svg" alt="pertamina" class="w-[300px] h-auto float-animation drop-shadow-2xl">
        </div>
      </div>

      <!-- @if($user->role == 1)
      <div class="bg-gray-100 p-6 rounded-lg">
        <div class="p-[16px] bg-[#D9D9D9] rounded-[12px]">
          <form action="/change-password" method="POST">
            {{ csrf_field() }}
            <p class="mb-[12px] font-bold">Change Password</p>

            <div class="grid gap-4 bg-[#B5B2B2] p-[12px] py-[16px] rounded-[12px]">
              <div>
                  <label for="old_password" class="block mb-2 text-sm font-medium text-gray-900">Old password</label>
                  <input type="password" id="old_password" name="old_password" class="bg-[#D9D9D9] border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required />
                  @if ($errors->has('old_password'))
                    <span class="text-red-500 text-xs mt-1">{{ $errors->first('old_password') }}</span>
                  @endif
              </div>
              <div>
                  <label for="new_password" class="block mb-2 text-sm font-medium text-gray-900">New password</label>
                  <input type="password" id="new_password" name="new_password" class="bg-[#D9D9D9] border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required />
                  @if ($errors->has('new_password'))
                    <span class="text-red-500 text-xs mt-1">{{ $errors->first('new_password') }}</span>
                  @endif
              </div>
              <div>
                  <label for="confirm_new_password" class="block mb-2 text-sm font-medium text-gray-900">Confirm password</label>
                  <input type="password" id="confirm_new_password" name="confirm_new_password" class="bg-[#D9D9D9] border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required />
                  @if ($errors->has('confirm_new_password'))
                    <span class="text-red-500 text-xs mt-1">{{ $errors->first('confirm_new_password') }}</span>
                  @endif
              </div>

              @if (session('success_message'))
                <div class="p-4 mb-4 text-sm text-white rounded-lg bg-green-500" role="alert">
                  <span class="font-medium">Success</span> {{ session('success_message') }}
                </div>
              @endif
            </div>

            <button type="submit" class="flex justify-self-end text-white mt-4 bg-primary hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
          </form>
        </div>
      </div>
      @endif -->

      @if($user->role == 2)
        <div class="bg-gray-100 p-3 drop-shadow-2xl animate-table rounded-lg">
          <div class="flex items-center justify-between mb-4">
            <h2 class="text-[24px] font-bold">Users List</h2>
            <button onclick="showModal()" type="button" class="text-white bg-primary hover:bg-blue-900 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">Buat Baru</button>
          </div>

          <div class="flex justify-between items-center mb-4">
            <div class="flex items-center">
              <span class="mr-2">Show</span>
              <select id="entriesPerPage" onchange="changeEntriesPerPage()" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 px-2 py-1">
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="all">All</option>
              </select>
              <span class="ml-2">entries</span>
            </div>
            
            <div class="relative">
              <input type="text" id="searchInput" onkeyup="searchUsers()" placeholder="Search users..." class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[250px] p-2.5">
            </div>
          </div>

          <div class="bg-[#D9D9D9] border-gray-300 rounded-[15px] overflow-hidden">
            <table class="w-full border bg-[#0056b3] border-collapse rounded-[12px]">
              <thead>
                <tr class="text-left text-white">
                  <th class="py-2 pl-4">No</th>
                  <th class="py-2 pl-4 cursor-pointer" onclick="sortUsers('name')">
                    Nama <span id="nameSort"></span>
                  </th>
                  <th class="py-2 pl-4 cursor-pointer" onclick="sortUsers('role')">
                    Role <span id="roleSort"></span>
                  </th>
                  <th class="py-2 pl-4">Workstation</th>
                  <th class="py-2 pl-4 cursor-pointer" onclick="sortUsers('verified')">
                    Status <span id="verifiedSort"></span>
                  </th>
                  <th class="py-2 pl-4">Aksi</th>
                </tr>
              </thead>
              <tbody id="usersTableBody">
              </tbody>
            </table>
          </div>

          <div class="flex items-center justify-between mt-4">
            <div class="text-sm text-gray-700">
              Showing <span id="showingStart">1</span> to <span id="showingEnd">10</span> of <span id="totalEntries">0</span> entries
            </div>
            <div class="flex gap-2">
              <button onclick="previousPage()" class="px-3 py-1 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100">Previous</button>
              <div id="paginationNumbers" class="flex gap-2"></div>
              <button onclick="nextPage()" class="px-3 py-1 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100">Next</button>
            </div>
          </div>
        </div>
      @endif
    </div>
  </div>

  <div id="edit-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bottom-0 z-[2000] justify-center items-center w-full md:inset-0 max-h-full p-4 bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow-sm">
          <!-- Modal header -->
          <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
              <h3 class="text-xl font-semibold text-gray-900">
                  Detail User
              </h3>
              <button onclick="closeModal()" type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                  </svg>
                  <span class="sr-only">Close modal</span>
              </button>
          </div>
          <!-- Modal body -->
          <div class="p-4 md:p-5">
              <form class="space-y-4" action="/update-user" method="POST">
                  {{ csrf_field() }}
                  <input type="hidden" id="edit-userId" name="userId" value="" />

                  <!-- Email -->
                  <div>
                      <label for="edit-email" class="block mb-2 text-sm font-medium text-gray-900">Email <span style="color: red">*</span></label>
                      <input type="email" name="email" id="edit-email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="name@company.com" required />
                      @error('email')
                          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                      @enderror
                  </div>

                  <!-- Nama -->
                  <div>
                      <label for="edit-name" class="block mb-2 text-sm font-medium text-gray-900">Nama <span style="color: red">*</span></label>
                      <input type="text" name="name" id="edit-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Nama" required />
                  </div>

                  <!-- Role -->
                  <div>
                      <label for="edit-role" class="block mb-2 text-sm font-medium text-gray-900">Role <span style="color: red">*</span></label>
                      <select name="role" id="edit-role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                          <option value="1">User</option>
                          <option value="2">Admin</option>
                      </select>
                  </div>

                  <!-- Workstations (tampilkan hanya jika role adalah User) -->
                  <div id="workstation-section">
                      <label class="block mb-2 text-sm font-medium text-gray-900">Workstations <span style="color: red">*</span></label>
                      <div class="space-y-2 max-h-[200px] overflow-y-auto bg-gray-50 border border-gray-300 rounded-lg p-3">
                          @foreach($branches as $branch)
                              <div class="flex items-center">
                                  <input type="checkbox" name="branches[]" id="branch-{{ $branch }}" value="{{ $branch }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                  <label for="branch-{{ $branch }}" class="ml-2 text-sm font-medium text-gray-900">{{ $branch }}</label>
                              </div>
                          @endforeach
                      </div>
                      <p class="mt-1 text-xs text-gray-500">Select one or more branches</p>
                  </div>

                  <!-- Password -->
                  <div>
                      <label for="edit-password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                      <input type="password" name="password" id="edit-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                  </div>
                  <div>
                      <label for="edit-password-confirmation" class="block mb-2 text-sm font-medium text-gray-900">Konfirmasi Password</label>
                      <input type="password" name="password_confirmation" id="edit-password-confirmation" placeholder="••••••••"
                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                  </div>

                  <!-- Submit button -->
                  <button id="btn-submit" type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
              </form>
          </div>
      </div>
    </div>
  </div>

  <script>
    const users = @json($users);
    const userById = users.reduce((prev, user) => {
      return {
        ...prev,
        [`${user.id}`]: user
      }
    }, {});

    const showModal = userId => {
      const user = userById[`${userId}`] || {};

      document.getElementById('edit-email').value = user.email || '';
      document.getElementById('edit-name').value = user.name || '';
      document.getElementById('edit-role').value = user.role || '';
      
      // Handle branch checkboxes
      const userBranches = user.branch_codes || [];
      document.querySelectorAll('input[name="branches[]"]').forEach(checkbox => {
        checkbox.checked = userBranches.includes(checkbox.value);
      });
      
      document.getElementById('edit-userId').value = user.id || '';
      document.getElementById('btn-submit').innerHTML = user.id ? 'Update' : 'Buat';

      if (+userId === 1) {
        document.getElementById('edit-role').setAttribute('disabled', 'disabled');
      } else {
        document.getElementById('edit-role').removeAttribute('disabled');
      }

      if (!+userId) {
        document.getElementById('edit-password').setAttribute('required', 'required');
      } else {
        document.getElementById('edit-password').removeAttribute('required');
      }

      document.getElementById('edit-modal').classList.remove('hidden');
      document.getElementById('edit-modal').classList.add('flex');
    };

    const closeModal = () => {
      document.getElementById('edit-modal').classList.remove('flex');
      document.getElementById('edit-modal').classList.add('hidden');
    };

    const deleteConfirm = (userId) => {
      const user = userById[`${userId}`];

      Swal.fire({
        title: 'Konfirmasi',
        text: `Kamu akan menghapus ${user.name} dari daftar user`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Konfirmasi'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = `/delete-user?userId=${userId}`;
        }
      });
    };

    const verifyConfirm = (userId) => {
      const user = userById[`${userId}`];

      Swal.fire({
        title: 'Konfirmasi',
        text: `Kamu akan verifikasi ${user.name}`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Konfirmasi'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = `/confirm-user?userId=${userId}`;
        }
      });
    };

    window.onload = async function() {
      @if (session('user_success_message'))
        await Swal.fire({
          title: 'Success',
          text: '{{ session('user_success_message') }}',
          icon: 'success',
          confirmButtonText: 'OK'
        });
      @endif
    }

    let currentPage = 1;
    let entriesPerPage = 10;
    let filteredUsers = [];
    let currentSort = {
      column: null,
      direction: 'asc'
    };

    function initializeTable() {
      filteredUsers = [...users];
      updateTable();
    }

    function sortUsers(column) {
      // Update sort direction
      if (currentSort.column === column) {
        currentSort.direction = currentSort.direction === 'asc' ? 'desc' : 'asc';
      } else {
        currentSort.column = column;
        currentSort.direction = 'asc';
      }

      // Update sort indicators in the UI
      updateSortIndicators();

      // Sort the filtered users
      filteredUsers.sort((a, b) => {
        // Always put pending users at the end
        if (a.verified !== b.verified) {
          return b.verified - a.verified;
        }

        let comparison = 0;
        switch (column) {
          case 'name':
            comparison = a.name.localeCompare(b.name);
            break;
          case 'role':
            comparison = a.role - b.role;
            break;
          case 'verified':
            comparison = a.verified - b.verified;
            break;
        }

        return currentSort.direction === 'asc' ? comparison : -comparison;
      });

      currentPage = 1;
      updateTable();
    }

    function updateSortIndicators() {
      // Reset all sort indicators
      ['name', 'role', 'verified'].forEach(column => {
        const element = document.getElementById(`${column}Sort`);
        if (element) {
          element.innerHTML = '';
        }
      });

      // Update current sort indicator
      if (currentSort.column) {
        const element = document.getElementById(`${currentSort.column}Sort`);
        if (element) {
          element.innerHTML = currentSort.direction === 'asc' ? ' ↑' : ' ↓';
        }
      }
    }

    function searchUsers() {
      const searchTerm = document.getElementById('searchInput').value.toLowerCase();
      filteredUsers = users.filter(user => 
        user.name.toLowerCase().includes(searchTerm) ||
        (user.role == 2 ? 'Admin' : 'User').toLowerCase().includes(searchTerm)
      );
      
      // Maintain current sort when searching
      if (currentSort.column) {
        sortUsers(currentSort.column);
      } else {
        currentPage = 1;
        updateTable();
      }
    }

    function changeEntriesPerPage() {
      const select = document.getElementById('entriesPerPage');
      entriesPerPage = select.value === 'all' ? filteredUsers.length : parseInt(select.value);
      currentPage = 1;
      updateTable();
    }

    function updateTable() {
      const startIndex = (currentPage - 1) * entriesPerPage;
      const endIndex = Math.min(startIndex + entriesPerPage, filteredUsers.length);
      const displayedUsers = filteredUsers.slice(startIndex, endIndex);

      const tbody = document.getElementById('usersTableBody');
      tbody.innerHTML = displayedUsers.map((user, index) => `
        <tr class="border-t border-gray-300 bg-white">
          <td class="p-2 pl-4">${startIndex + index + 1}</td>
          <td class="p-2 pl-4 w-[30%]">${user.name}</td>
          <td class="p-2 pl-4">${user.role == 2 ? 'Admin' : 'User'}</td>
          <td class="p-2 pl-4">
            ${user.branches ? user.branches.map(b => b.branch).join(', ') : '-'}
          </td>
          <td class="p-2 pl-4">
            <span class="text-[14px] px-2 py-1 rounded-md ${user.verified ? 'bg-green-200 text-green-600' : 'bg-yellow-200 text-yellow-600'}">
              ${user.verified ? 'Disetujui' : 'Pending'}
            </span>
          </td>
          <td class="p-2 pl-4">
            <div class="flex items-center gap-2">
              <button onclick="showModal(${user.id})" type="button" class="text-white bg-primary hover:bg-blue-800 focus:ring-4 focus:ring-blue-900 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">Detail</button>
              ${user.verified == 0 ? 
                `<button onclick="verifyConfirm(${user.id})" type="button" class="text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">Setujui</button>` 
                : ''
              }
              ${user.id != 1 ? 
                `<button onclick="deleteConfirm(${user.id})" type="button" class="text-white bg-red-500 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">Hapus</button>`
                : ''
              }
            </div>
          </td>
        </tr>
      `).join('');

      updatePagination();
      updateShowingInfo(startIndex, endIndex);
    }

    function updatePagination() {
      const totalPages = Math.ceil(filteredUsers.length / entriesPerPage);
      const paginationNumbers = document.getElementById('paginationNumbers');
      paginationNumbers.innerHTML = '';

      for (let i = 1; i <= totalPages; i++) {
        const button = document.createElement('button');
        button.textContent = i;
        button.className = `px-3 py-1 text-sm ${currentPage === i ? 'text-white bg-primary' : 'text-gray-700 bg-white'} border border-gray-300 rounded-lg hover:bg-gray-100`;
        button.onclick = () => {
          currentPage = i;
          updateTable();
        };
        paginationNumbers.appendChild(button);
      }
    }

    function updateShowingInfo(startIndex, endIndex) {
      document.getElementById('showingStart').textContent = filteredUsers.length === 0 ? 0 : startIndex + 1;
      document.getElementById('showingEnd').textContent = endIndex;
      document.getElementById('totalEntries').textContent = filteredUsers.length;
    }

    function previousPage() {
      if (currentPage > 1) {
        currentPage--;
        updateTable();
      }
    }

    function nextPage() {
      const totalPages = Math.ceil(filteredUsers.length / entriesPerPage);
      if (currentPage < totalPages) {
        currentPage++;
        updateTable();
      }
    }

    // Initialize the table when the page loads
    window.addEventListener('load', function() {
      initializeTable();
    });

        document.addEventListener('DOMContentLoaded', function () {
        const roleSelect = document.getElementById('edit-role');
        const workstationSection = document.getElementById('workstation-section');

        function toggleWorkstation() {
            if (roleSelect.value === '1') {
                workstationSection.style.display = 'block';
            } else {
                workstationSection.style.display = 'none';
                // Optional: uncheck all checkboxes when hidden
                workstationSection.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
            }
        }

        // Initial check on page load
        toggleWorkstation();

        // Update when role is changed
        roleSelect.addEventListener('change', toggleWorkstation);
    });
  </script>
@endsection
