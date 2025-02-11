import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import precognition from 'laravel-precognition-alpine';

// Call Alpine.
window.Alpine = Alpine
Alpine.plugin([precognition])
Livewire.start()
