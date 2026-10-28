@extends('layouts.app')

@section('meta_title', 'IJSREAT | Contact Us – International Journal of Scientific Research in Engineering & Technology')
@section('meta_description', 'Get in touch with IJSREAT for paper submissions, editorial queries, or publication support. Contact us via email, phone, or visit our office in Tamil Nadu, India.')

@include('archives.partials.theme')

@section('content')
<div class="hp">
    <x-archive.pageband title="Contact Us" :crumbs="['Contact Us' => null]"
        lead="Have questions about manuscript submission, peer review process, or journal guidelines? Contact our editorial board or publisher office using the form below. We usually respond within 24-48 business hours." />

    <div class="apage" style="grid-template-columns:1fr">
        <div class="amain">
            <div class="ct-grid">
                <div class="dcard" x-data="{
                 form: {
                     name: '',
                     email: '',
                     mobileNumber: '',
                     message: ''
                 },
                 errors: {
                     name: '',
                     email: '',
                     mobileNumber: '',
                     message: ''
                 },
                 loading: false,
                 statusMessage: '',
                 statusType: '', // 'success' or 'error'

                 validate() {
                     let valid = true;
                     this.errors = { name: '', email: '', mobileNumber: '', message: '' };

                     if (!this.form.name.trim()) {
                         this.errors.name = 'Name is required';
                         valid = false;
                     }
                     if (!this.form.email.trim()) {
                         this.errors.email = 'Email is required';
                         valid = false;
                     } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.form.email)) {
                         this.errors.email = 'Valid email is required';
                         valid = false;
                     }
                     if (!this.form.mobileNumber.trim()) {
                         this.errors.mobileNumber = 'Mobile number is required';
                         valid = false;
                     }
                     if (!this.form.message.trim()) {
                         this.errors.message = 'Message is required';
                         valid = false;
                     }
                     return valid;
                 },

                 submitForm() {
                     if (!this.validate()) return;
                     
                     this.loading = true;
                     this.statusMessage = '';
                     this.statusType = '';

                     fetch('{{ route('contact.submit') }}', {
                         method: 'POST',
                         headers: {
                             'Content-Type': 'application/json',
                             'X-CSRF-TOKEN': '{{ csrf_token() }}',
                             'Accept': 'application/json'
                         },
                         body: JSON.stringify(this.form)
                     })
                     .then(response => response.json().then(data => ({ status: response.status, body: data })))
                     .then(res => {
                         this.loading = false;
                         if (res.status === 200 && res.body.success) {
                             this.statusType = 'success';
                             this.statusMessage = res.body.message || 'Your message has been sent successfully!';
                             this.form = { name: '', email: '', mobileNumber: '', message: '' };
                         } else {
                             this.statusType = 'error';
                             this.statusMessage = res.body.message || 'Something went wrong. Please try again.';
                         }
                     })
                     .catch(err => {
                         this.loading = false;
                         this.statusType = 'error';
                         this.statusMessage = 'An unexpected error occurred. Please try again later.';
                     });
                 }
             }">
                    <div class="dcard__head"><h2><span class="tic"><x-homepage.icon name="send" /></span> Send us a message</h2></div>

                    <form class="form dcard__body" novalidate @submit.prevent="submitForm">
                        <div class="fgrid">
                            <div class="field" :class="{ 'has-err': errors.name }">
                                <label for="name">Your Name <b>*</b></label>
                                <input type="text" id="name" x-model="form.name" placeholder="e.g. John Doe" autocomplete="name">
                                <small class="err" x-show="errors.name" x-text="errors.name"></small>
                            </div>
                            <div class="field" :class="{ 'has-err': errors.email }">
                                <label for="email">Your Email <b>*</b></label>
                                <input type="email" id="email" x-model="form.email" placeholder="e.g. john@example.com" autocomplete="email">
                                <small class="err" x-show="errors.email" x-text="errors.email"></small>
                            </div>
                            <div class="field full" :class="{ 'has-err': errors.mobileNumber }">
                                <label for="mobileNumber">Mobile Number <b>*</b></label>
                                <input type="tel" id="mobileNumber" x-model="form.mobileNumber" placeholder="e.g. +91 98765 43210" autocomplete="tel">
                                <small class="err" x-show="errors.mobileNumber" x-text="errors.mobileNumber"></small>
                            </div>
                            <div class="field full" :class="{ 'has-err': errors.message }">
                                <label for="message">Your Message <b>*</b></label>
                                <textarea id="message" x-model="form.message" rows="6" placeholder="Type your query or message details here..."></textarea>
                                <small class="err" x-show="errors.message" x-text="errors.message"></small>
                            </div>
                        </div>

                        <div class="fstatus" :class="statusType === 'success' ? 'fstatus--ok' : 'fstatus--err'" x-show="statusMessage" x-text="statusMessage" role="status" aria-live="polite"></div>

                        <div>
                            <button type="submit" class="button button--solid" :disabled="loading">
                                <x-homepage.icon name="send" /> <span x-text="loading ? 'Sending Message...' : 'Send Message'">Send Message</span>
                            </button>
                        </div>
                    </form>
                </div>

                <aside class="ct-side" aria-label="Contact details">
                    <div class="dcard">
                        <div class="dcard__head"><h2><span class="tic"><x-homepage.icon name="building" /></span> Editorial office</h2></div>
                        <div class="dcard__body" style="padding-top:4px;padding-bottom:4px">
                        <div class="ct-card"><span class="tic tic--sm"><x-homepage.icon name="mail" /></span><div><b>Email</b><a href="mailto:editorinchief@ijsreat.com">editorinchief@ijsreat.com</a></div></div>
                        <div class="ct-card"><span class="tic tic--sm"><x-homepage.icon name="phone" /></span><div><b>Mobile</b><a href="tel:+919840521421">+91 9840521421</a></div></div>
                        <div class="ct-card"><span class="tic tic--sm"><x-homepage.icon name="pin" /></span><div><b>Address</b><span>Fifth Dimension Research Publication (P) Ltd. No: 38D5F, Rajaji Nagar, Ariyalur–621713. Tamilnadu, India.</span></div></div>
                        </div>
                    </div>
                    <div class="qlinks">
                        <a class="qlink" href="/paper-status"><x-homepage.icon name="search" /> Check paper status</a>
                        <a class="qlink" href="/FAQs"><x-homepage.icon name="help" /> Frequently asked questions</a>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>
@endsection
