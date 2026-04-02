# 🤖 AI Agent Prompt: NativePHP Countdown App

## Project Overview

Build a simple **Countdown (Counter) App** using **Laravel + NativePHP Mobile + Livewire**.
The app will be compiled as an **Android APK** and tested on a real device via **Jump app**.

---

## Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 11+ |
| Mobile | NativePHP Mobile v3 (nativephp/mobile) |
| Frontend | Livewire v3 |
| Styling | Tailwind CSS |
| Target Platform | Android (APK) |

---

## App Requirements

### Core Feature: Counter

Build a **single-screen counter app** with the following behavior:

- Display a **large number** in the center of the screen (starts at `0`)
- A **`+` (Plus) button** — pressing it **increments** the counter by 1
- A **`-` (Minus) button** — pressing it **decrements** the counter by 1
- Counter value must **never go below `0`** (minimum is 0)
- A **Reset button** — pressing it resets the counter back to `0`

---

## File Structure to Create

```
app/
  Livewire/
    Counter.php          ← Livewire component (backend logic)

resources/
  views/
    livewire/
      counter.blade.php  ← Livewire component view (UI)
    layouts/
      app.blade.php      ← Main mobile layout

routes/
  web.php                ← Single route pointing to counter
```

---

## Detailed Instructions

### 1. Livewire Component — `app/Livewire/Counter.php`

```php
<?php

namespace App\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public int $count = 0;

    public function increment(): void
    {
        $this->count++;
    }

    public function decrement(): void
    {
        if ($this->count > 0) {
            $this->count--;
        }
    }

    public function reset(): void
    {
        $this->count = 0;
    }

    public function render()
    {
        return view('livewire.counter')
            ->layout('layouts.app');
    }
}
```

### 2. Livewire View — `resources/views/livewire/counter.blade.php`

- Full-screen layout, centered vertically and horizontally
- Large, bold number display (the counter value)
- `+` button — calls `increment()`
- `-` button — calls `decrement()`
- `Reset` button — calls `reset()`
- Use **Tailwind CSS** for styling
- Buttons must be **large and finger-friendly** (mobile touch targets: min 56px height)
- Clean, minimal UI suitable for a mobile screen

### 3. Layout — `resources/views/layouts/app.blade.php`

- Minimal HTML5 layout
- Include Tailwind CSS via CDN
- Include Livewire scripts and styles
- `<meta name="viewport" content="width=device-width, initial-scale=1.0">`
- No desktop navigation, no sidebar — pure mobile layout

### 4. Route — `routes/web.php`

```php
use App\Livewire\Counter;

Route::get('/', Counter::class);
```

---

## NativePHP Setup (already done, just verify)

Make sure `.env` contains:

```env
NATIVEPHP_APP_ID=com.yourname.counter
NATIVEPHP_APP_VERSION="1.0"
NATIVEPHP_APP_VERSION_CODE="1"
```

---

## Testing on Real Device (Samsung Android)

After building, test using **Jump app**:

```bash
php artisan native:jump
```

1. Open **Jump app** on your Samsung device
2. Scan the QR code shown in the browser
3. App loads directly on your phone — no APK install needed for testing

---

## UI Design Guidelines

- Background: **dark** (`bg-gray-900` or `bg-zinc-950`)
- Counter number: **very large white text** (`text-9xl font-bold text-white`)
- `+` button: **green** (`bg-green-500`)
- `-` button: **red** (`bg-red-500`)
- `Reset` button: **gray/subtle** (`bg-gray-600 text-sm`)
- Buttons: **rounded-full**, large, centered, with enough spacing for touch

---

## Expected Final Result

A clean, minimal counter app that:
- Opens full-screen on Android
- Shows `0` at launch
- Increments on `+` tap
- Decrements on `-` tap (stops at 0)
- Resets on `Reset` tap
- Works offline, no internet required
- Runs natively on Android via NativePHP

---

## Notes for AI Agent

- Do **not** use Alpine.js or Vue — use **Livewire only**
- Do **not** add a database or migrations — keep state in Livewire component property
- Do **not** add authentication or user sessions
- Keep the code **as simple as possible** — this is a beginner-friendly project
- Make sure Livewire is installed: `composer require livewire/livewire`
- If Livewire is not installed, install it first before generating components
