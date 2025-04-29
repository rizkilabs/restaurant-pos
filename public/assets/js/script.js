async function loadDatabase() {
  return {
    getProducts: async () => {
      const response = await fetch('/api/products');
      if (!response.ok) {
        console.log(reponse)
        throw new Error("Gagal mengambil data produk")
      
      };

      return await response.json();
    }
  };
}


function initApp() {
  const app = {
    products: [],
    keyword: "",
    cart: [],
    cash: 0,
    change: 0,
    isShowModalReceipt: false,
    receiptNo: null,
    receiptDate: null,
    moneys: [2000, 5000, 10000, 20000, 50000, 100000],
    activeMenu: 'pos',

    async initDatabase() {
      await this.loadProducts();
    },

    async loadProducts() {
      try {
        const response = await fetch('/api/products');
        if (!response.ok) throw new Error("Gagal mengambil data produk");
        this.products = await response.json();
        console.log("products loaded", this.products);
      } catch (error) {
        console.error("Error loading products:", error);
      }
    },

    filteredProducts() {
      const rg = this.keyword ? new RegExp(this.keyword, "gi") : null;
      return this.products.filter((p) => !rg || p.product_name.match(rg));
    },

    addToCart(product) {
      const index = this.findCartIndex(product);
      if (index === -1) {
        this.cart.push({
          productId: product.id,
          image: product.product_photo,
          name: product.product_name,
          price: product.product_price,
          option: null,
          qty: 1,
        });
      } else {
        this.cart[index].qty += 1;
      }
      this.beep();
      this.updateChange();
    },

    findCartIndex(product) {
      return this.cart.findIndex((p) => p.productId === product.id);
    },

    addQty(item, qty) {
      const index = this.cart.findIndex((i) => i.productId === item.productId);
      if (index === -1) return;

      const afterAdd = item.qty + qty;
      if (afterAdd === 0) {
        this.cart.splice(index, 1);
        this.clearSound();
      } else {
        this.cart[index].qty = afterAdd;
        this.beep();
      }
      this.updateChange();
    },

    addCash(amount) {
      this.cash = (this.cash || 0) + amount;
      this.updateChange();
      this.beep();
    },

    updateCash(value) {
      this.cash = parseFloat(value.replace(/[^0-9]+/g, ""));
      this.updateChange();
    },

    updateChange() {
      this.change = this.cash - this.getTotalPrice();
    },

    getTotalPrice() {
      return this.cart.reduce((total, item) => total + item.qty * item.price, 0);
    },

    getItemsCount() {
      return this.cart.reduce((count, item) => count + item.qty, 0);
    },

    submitable() {
      return this.change >= 0 && this.cart.length > 0;
    },

    submit() {
      const time = new Date();
      this.isShowModalReceipt = true;
      this.receiptNo = `TWPOS-KS-${Math.round(time.getTime() / 1000)}`;
      this.receiptDate = this.dateFormat(time);
    },

    // async printAndProceed() {
    //   const receiptContent = document.getElementById('receipt-content');
    //   const titleBefore = document.title;
    //   const printArea = document.getElementById('print-area');

    //   printArea.innerHTML = receiptContent.innerHTML;
    //   document.title = this.receiptNo;
    //   window.print();
    //   document.title = titleBefore;
    //   printArea.innerHTML = '';
    //   this.isShowModalReceipt = false;

    //   // Simpan ke database
    //   const payload = {
    //     order_code: this.receiptNo,
    //     order_detail: this.cart.map(item => ({
    //       product_id: item.productId,
    //       qty: item.qty,
    //       order_price: item.price,
    //       order_subtotal: item.qty * item.price
    //     })),
    //     order_amount: this.getTotalPrice(),
    //     order_change: this.change,
    //     order_status: 'PAID'
    //   };

    //   try {
    //     const response = await fetch('/api/orders', {
    //       method: 'POST',
    //       headers: {
    //         'Content-Type': 'application/json',
    //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    //       },
    //       body: JSON.stringify(payload)
    //     });

    //     if (!response.ok) throw new Error("Gagal menyimpan transaksi");
    //     alert("Transaksi berhasil disimpan!");
    //     this.clear();
    //   } catch (error) {
    //     console.error(error);
    //     alert("Gagal menyimpan transaksi");
    //   }

    //   // Delay agar Alpine selesai render x-for dan x-text
    //   // setTimeout(() => {
    //   //     printArea.innerHTML = receiptContent.innerHTML;
    //   //     document.title = this.receiptNo;
    //   //     window.print();
    //   //     document.title = titleBefore;
    //   //     printArea.innerHTML = '';
    //   //     this.isShowModalReceipt = false;
    //   //     this.clear();
    //   // }, 300); // delay 300ms aman untuk Alpine
    // }
    async printAndProceed() {
      const printArea = document.getElementById('print-area');
      const titleBefore = document.title;

      let receiptItemsHtml = '';
      this.cart.forEach((item, index) => {
        receiptItemsHtml += `
          <tr>
            <td class="py-2 text-center">${index + 1}</td>
            <td class="py-2 text-left">
              <span>${item.name}</span><br />
              <small>${this.priceFormat(item.price)}</small>
            </td>
            <td class="py-2 text-center">${item.qty}</td>
            <td class="py-2 text-right">${this.priceFormat(item.qty * item.price)}</td>
          </tr>
        `;
      });

      const receiptContentHtml = `
        <div class="p-4">
          <h3 class="text-xl font-semibold text-center mb-4">Receipt</h3>
          <p class="text-sm text-center mb-2">No: ${this.receiptNo}</p>
          <p class="text-sm text-center mb-4">Date: ${this.receiptDate}</p>
          <table class="w-full text-sm">
            <thead>
              <tr>
                <th class="py-2 text-left">No</th>
                <th class="py-2 text-left">Item</th>
                <th class="py-2 text-center">Qty</th>
                <th class="py-2 text-right">Subtotal</th>
              </tr>
            </thead>
            <tbody>
              ${receiptItemsHtml}
            </tbody>
            <tfoot>
              <tr>
                <td colspan="3" class="py-2 text-right font-semibold">Total</td>
                <td class="py-2 text-right font-semibold">${this.priceFormat(this.getTotalPrice())}</td>
              </tr>
              <tr>
                <td colspan="3" class="py-2 text-right font-semibold">Cash</td>
                <td class="py-2 text-right font-semibold">${this.priceFormat(this.cash)}</td>
              </tr>
              <tr>
                <td colspan="3" class="py-2 text-right font-semibold">Change</td>
                <td class="py-2 text-right font-semibold">${this.priceFormat(this.change)}</td>
              </tr>
            </tfoot>
          </table>
          <p class="text-xs text-center mt-4">Thank you for your purchase!</p>
        </div>
      `;

      printArea.innerHTML = receiptContentHtml;
      document.title = this.receiptNo;
      window.print();
      document.title = titleBefore;
      printArea.innerHTML = '';
      this.isShowModalReceipt = false;

      const payload = {
        order_code: this.receiptNo,
        order_status: 'PAID',
        order_amount: this.getTotalPrice(),
        order_change: this.change,
        products: this.cart.map(item => ({
          product_id: item.productId,
          qty: item.qty,
          order_price: item.price,
          order_subtotal: item.qty * item.price
        }))
      };
      
      
      

      try {
        const response = await fetch('/api/orders', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          },
          body: JSON.stringify(payload)
        });

        if (!response.ok) throw new Error("Gagal menyimpan transaksi");
        alert("Transaksi berhasil disimpan!");
        this.clear();
      } catch (error) {
        console.error(error);
        alert("Gagal menyimpan transaksi");
      }
    },
    

    closeModalReceipt() {
      this.isShowModalReceipt = false;
    },

    clear() {
      this.cash = 0;
      this.cart = [];
      this.receiptNo = null;
      this.receiptDate = null;
      this.updateChange();
      this.clearSound();
    },

    beep() {
      this.playSound("assets/sound/beep-29.mp3");
    },

    clearSound() {
      this.playSound("assets/sound/button-21.mp3");
    },

    playSound(src) {
      const sound = new Audio();
      sound.src = src;
      sound.play();
      sound.onended = () => delete(sound);
    },

    // numberFormat(number) {
    //   return (number || "")
    //     .toString()
    //     .replace(/^0|\./g, "")
    //     .replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
    // },

    numberFormat(number) {
      return new Intl.NumberFormat('id-ID').format(Math.round(number));
    },
    

    priceFormat(number) {
      return number ? `Rp ${this.numberFormat(number)}` : `Rp 0`;
    },

    dateFormat(date) {
      const formatter = new Intl.DateTimeFormat('id', {
        dateStyle: 'short',
        timeStyle: 'short'
      });
      return formatter.format(date);
    }
  };

  return app;
}
