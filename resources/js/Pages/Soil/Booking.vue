<template>
  <div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-4xl mx-auto">
      <h1 class="text-3xl font-bold text-gray-900 mb-8">Book Soil Test</h1>
      
      <!-- Testing Guide Modal -->
      <div v-if="showGuide" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-2xl mx-4">
          <h2 class="text-xl font-bold mb-4">Chemical Soil Testing Guide</h2>
          <div class="prose">
            <p>This guide explains the soil testing procedure:</p>
            <ul class="list-disc pl-6 mt-2">
              <li>Collect samples from designated locations</li>
              <li>Test at surface level and 30cm depth</li>
              <li>Record ambient conditions</li>
              <li>Follow GPS coordinates precisely</li>
            </ul>
          </div>
          <div class="flex justify-end mt-6 space-x-4">
            <button @click="showGuide = false" class="px-4 py-2 text-gray-600 border rounded">Cancel</button>
            <button @click="confirmGuide" class="px-4 py-2 bg-green-600 text-white rounded">I Understand</button>
          </div>
        </div>
      </div>

      <!-- Vendor Selection -->
      <div v-if="guideConfirmed" class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">Select Vendor & Date</h2>
        
        <!-- Date Selection -->
        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-700 mb-2">Pickup Date</label>
          <input 
            v-model="pickupDate" 
            type="date" 
            :min="minDate"
            class="border rounded-lg px-3 py-2"
            @change="loadVendors"
          >
          <label class="flex items-center mt-2">
            <input v-model="allowExtraDay" type="checkbox" class="mr-2">
            <span class="text-sm">Allow extra day (4-day window)</span>
          </label>
        </div>

        <!-- Vendor List -->
        <div v-if="vendors.length" class="space-y-4">
          <div 
            v-for="vendor in vendors" 
            :key="vendor.id"
            @click="selectVendor(vendor)"
            class="border rounded-lg p-4 cursor-pointer hover:bg-blue-50"
            :class="{ 'border-blue-500 bg-blue-50': selectedVendor?.id === vendor.id }"
          >
            <h3 class="font-medium">{{ vendor.name }}</h3>
            <p class="text-sm text-gray-600">{{ vendor.location_name }}</p>
            <p class="text-sm text-green-600">{{ vendor.available_kits_count }} kits available</p>
            <p class="text-sm text-gray-500">{{ vendor.distance?.toFixed(1) }} km away</p>
          </div>
        </div>

        <!-- Booking Summary -->
        <div v-if="selectedVendor" class="mt-6 p-4 bg-gray-50 rounded-lg">
          <h3 class="font-medium mb-2">Booking Summary</h3>
          <p><strong>Pickup:</strong> {{ formatDate(pickupDate) }}</p>
          <p><strong>Testing:</strong> {{ formatDate(testingDate) }}</p>
          <p><strong>Return:</strong> {{ formatDate(returnDate) }}</p>
          <p><strong>Vendor:</strong> {{ selectedVendor.name }}</p>
          <p><strong>Total Cost:</strong> KES 2,500</p>
          
          <button 
            @click="proceedToPayment"
            class="mt-4 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700"
          >
            Proceed to Payment
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  soilTest: Object
})

const showGuide = ref(true)
const guideConfirmed = ref(false)
const pickupDate = ref('')
const allowExtraDay = ref(false)
const vendors = ref([])
const selectedVendor = ref(null)

const minDate = computed(() => {
  const tomorrow = new Date()
  tomorrow.setDate(tomorrow.getDate() + 1)
  return tomorrow.toISOString().split('T')[0]
})

const testingDate = computed(() => {
  if (!pickupDate.value) return ''
  const date = new Date(pickupDate.value)
  date.setDate(date.getDate() + 1)
  return date.toISOString().split('T')[0]
})

const returnDate = computed(() => {
  if (!pickupDate.value) return ''
  const date = new Date(pickupDate.value)
  date.setDate(date.getDate() + (allowExtraDay.value ? 3 : 2))
  return date.toISOString().split('T')[0]
})

const confirmGuide = () => {
  showGuide.value = false
  guideConfirmed.value = true
}

const loadVendors = async () => {
  if (!pickupDate.value) return
  
  try {
    const response = await fetch(`/vendors/nearby?farm_id=${props.soilTest.farm_id}&pickup_date=${pickupDate.value}&allow_extra_day=${allowExtraDay.value}`)
    vendors.value = await response.json()
  } catch (error) {
    console.error('Error loading vendors:', error)
  }
}

const selectVendor = (vendor) => {
  selectedVendor.value = vendor
}

const proceedToPayment = async () => {
  try {
    const response = await fetch(`/soil/tests/${props.soilTest.id}/book`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify({
        vendor_id: selectedVendor.value.id,
        pickup_at: pickupDate.value,
        allow_extra_day: allowExtraDay.value
      })
    })
    
    if (response.ok) {
      router.visit(`/soil/tests/${props.soilTest.id}/payment`)
    }
  } catch (error) {
    console.error('Error booking test:', error)
  }
}

const formatDate = (dateStr) => {
  if (!dateStr) return ''
  return new Date(dateStr).toLocaleDateString()
}

onMounted(() => {
  // Set default pickup date to tomorrow
  pickupDate.value = minDate.value
})
</script>
