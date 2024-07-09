<!-- resources/js/components/ReceiptModal.vue -->

<template>
    <div>
      <b-modal v-model="showModal" title="Receipt" @ok="printReceipt">
        <!-- Receipt content -->
        <div class="receipt-container">
          <p>Date: {{ currentDate }}</p>
          <p>Customer: {{ customerName }}</p>
          <p>Total Amount: ${{ totalAmount }}</p>
        </div>
      </b-modal>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        showModal: false,
        currentDate: new Date().toLocaleDateString(),
        customerName: 'John Doe',
        totalAmount: 50.00
      };
    },
    methods: {
      printReceipt() {
        // Implement printing functionality here (optional)
        window.print();
      }
    }
  };
  </script>
  
  <style>
  .receipt-container {
    font-family: Arial, sans-serif;
  }
  </style>
  