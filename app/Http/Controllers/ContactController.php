<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;

/**
 * Gestion du formulaire de contact (affichage + envoi).
 */
final class ContactController extends Controller
{
    /**
     * Affiche la page de contact.
     *
     * @return ViewContract
     */
    public function create(): ViewContract
    {
        return view('contact.index');
    }

    /**
     * Traite l'envoi du formulaire de contact.
     * - Limite de 3 tentatives par IP avant blocage temporaire.
     * - Champ "website" = honeypot (bot trap).
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $key = 'contact:' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            return back()->with('error', 'Trop de tentatives. Réessayez dans quelques minutes.');
        }

        // Honeypot: si rempli, on fait comme si tout s’était bien passé
        if ($request->filled('website')) {
            return back()->with('success', 'Message envoyé !');
        }

        $validated = $request->validate(
            [
                'name'    => 'required|string|max:255',
                'email'   => 'required|email|max:255',
                'message' => 'required|string|min:10|max:2000',
            ],
            [
                'name.required'    => 'Le nom est obligatoire.',
                'email.required'   => 'L\'email est obligatoire.',
                'email.email'      => 'L\'email doit être valide.',
                'message.required' => 'Le message est obligatoire.',
                'message.min'      => 'Le message doit contenir au moins 10 caractères.',
            ]
        );

        try {
            Mail::send('emails.contact', $validated, function ($mail) use ($validated): void {
                $mail->to('nawfel.idaali.pro@gmail.com')
                    ->replyTo($validated['email'], $validated['name'])
                    ->subject('Nouveau message depuis Noferu');
            });

            // 10 minutes de cooldown après un envoi réussi
            RateLimiter::hit($key, 600);

            return back()->with('success', 'Message envoyé avec succès ! Je vous répondrai rapidement.');
        } catch (\Throwable $e) {
            // Option: ajouter un Log::error($e->getMessage()) si désiré
            return back()->with('error', 'Une erreur est survenue. Veuillez réessayer.');
        }
    }
}
