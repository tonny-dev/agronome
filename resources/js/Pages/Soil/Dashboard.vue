<template>
  <div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-7xl mx-auto">
      <h1 class="text-3xl font-bold text-gray-900 mb-8">Soil Testing Dashboard</h1>
      
      <!-- Farm Selection -->
      <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">Select Farm for Chemical Testing</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          <div 
            v-for="farm in farms" 
            :key="farm.id"
            @click="selectFarm(farm)"
            class="border rounded-lg p-4 cursor-pointer hover:bg-blue-50 hover:border-blue-300"
            :class="{ 'border-blue-500 bg-blue-50': selectedFarm?.id === farm.id }"
          >
            <h3 class="font-medium">{{ farm.name }}</h3>
            <p class="text-sm text-gray-600">{{ farm.county?.name }}, {{ farm.subcounty?.name }}</p>
            <p class="text-sm text-gray-500">{{ farm.size_hectares }} hectares</p>
          </div>
        </div>
        
        <button 
          v-if="selectedFarm"
          @click="startChemicalTest"
          class="mt-4 bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700"
        >
          Start Chemical Test
        </button>
      </div>

      <!-- Recent Tests -->
      <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold mb-4">Recent Tests</h2>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Farm</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="test in recentTests" :key="test.id">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                  {{ test.farm.name }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 py-1 text-xs font-semibold rounded-full"
                        :class="getStatusClass(test.status)">
                    {{ formatStatus(test.status) }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ formatDate(test.created_at) }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <button class="text-blue-600 hover:text-blue-900">View</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  farms: Array,
  recentTests: Array
})

const selectedFarm = ref(null)

const selectFarm = (farm) => {
  selectedFarm.value = farm
}

const startChemicalTest = async () => {
  try {
    const response = await fetch('/soil/tests', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify({
        farm_id: selectedFarm.value.id,
        type: 'chemical'
      })
    })
    
    const data = await response.json()
    router.visit(`/soil/tests/${data.soil_test_id}/book`)
  } catch (error) {
    console.error('Error starting test:', error)
  }
}

const getStatusClass = (status) => {
  const classes = {
    draft: 'bg-gray-100 text-gray-800',
    booked: 'bg-yellow-100 text-yellow-800',
    paid: 'bg-blue-100 text-blue-800',
    testing: 'bg-orange-100 text-orange-800',
    analysis_unlocked: 'bg-green-100 text-green-800'
  }
  return classes[status] || 'bg-gray-100 text-gray-800'
}

const formatStatus = (status) => {
  return status.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase())
}

const formatDate = (date) => {
  return new Date(date).toLocaleDateString()
}
</script>
