@extends('layouts.app')

@php
$starSvg = <<<SVG
<svg class="w-8 h-8 text-black-900 -mt-1 relative" viewBox="0 0 48 48" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
    <path d="M23.9988 40.212L12.3651 47.5499C11.8511 47.8923 11.3138 48.0391 10.7532 47.9902C10.1925 47.9413 9.70191 47.7456 9.28142 47.4031C8.86092 47.0607 8.53387 46.6331 8.30026 46.1205C8.06665 45.6078 8.01993 45.0325 8.16009 44.3946L11.2437 30.5259L0.941565 21.2067C0.474346 20.7664 0.182802 20.2645 0.0669313 19.7009C-0.0489389 19.1374 -0.0143649 18.5875 0.170654 18.0514C0.355672 17.5152 0.636003 17.0749 1.01165 16.7305C1.38729 16.3861 1.90123 16.166 2.55347 16.0701L16.1495 14.8227L21.4057 1.76111C21.6394 1.17407 22.0019 0.733794 22.4934 0.440277C22.9849 0.146759 23.4867 0 23.9988 0C24.5109 0 25.0127 0.146759 25.5042 0.440277C25.9957 0.733794 26.3583 1.17407 26.5919 1.76111L31.8481 14.8227L45.4441 16.0701C46.0982 16.1679 46.6122 16.3881 46.986 16.7305C47.3597 17.073 47.6401 17.5132 47.827 18.0514C48.0138 18.5895 48.0494 19.1403 47.9335 19.7039C47.8176 20.2674 47.5251 20.7684 47.056 21.2067L36.7539 30.5259L39.8375 44.3946C39.9777 45.0305 39.931 45.6058 39.6974 46.1205C39.4637 46.6351 39.1367 47.0627 38.7162 47.4031C38.2957 47.7436 37.8051 47.9393 37.2445 47.9902C36.6838 48.041 36.1465 47.8943 35.6325 47.5499L23.9988 40.212Z"/>
</svg>
SVG;
$starSvgSm = <<<SVG
<svg class="w-3 h-3 text-blue-600 -mt-0.5 relative" viewBox="0 0 48 48" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
    <path d="M23.9988 40.212L12.3651 47.5499C11.8511 47.8923 11.3138 48.0391 10.7532 47.9902C10.1925 47.9413 9.70191 47.7456 9.28142 47.4031C8.86092 47.0607 8.53387 46.6331 8.30026 46.1205C8.06665 45.6078 8.01993 45.0325 8.16009 44.3946L11.2437 30.5259L0.941565 21.2067C0.474346 20.7664 0.182802 20.2645 0.0669313 19.7009C-0.0489389 19.1374 -0.0143649 18.5875 0.170654 18.0514C0.355672 17.5152 0.636003 17.0749 1.01165 16.7305C1.38729 16.3861 1.90123 16.166 2.55347 16.0701L16.1495 14.8227L21.4057 1.76111C21.6394 1.17407 22.0019 0.733794 22.4934 0.440277C22.9849 0.146759 23.4867 0 23.9988 0C24.5109 0 25.0127 0.146759 25.5042 0.440277C25.9957 0.733794 26.3583 1.17407 26.5919 1.76111L31.8481 14.8227L45.4441 16.0701C46.0982 16.1679 46.6122 16.3881 46.986 16.7305C47.3597 17.073 47.6401 17.5132 47.827 18.0514C48.0138 18.5895 48.0494 19.1403 47.9335 19.7039C47.8176 20.2674 47.5251 20.7684 47.056 21.2067L36.7539 30.5259L39.8375 44.3946C39.9777 45.0305 39.931 45.6058 39.6974 46.1205C39.4637 46.6351 39.1367 47.0627 38.7162 47.4031C38.2957 47.7436 37.8051 47.9393 37.2445 47.9902C36.6838 48.041 36.1465 47.8943 35.6325 47.5499L23.9988 40.212Z"/>
</svg>
SVG;

$totalRatings = $allReviews->count();
$averageRating = 0;
$ratingCounts = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];

if ($totalRatings > 0) {
    // Calculate sum of all ratings
    $sumOfRatings = $allReviews->sum('rating');
    
    // Calculate average and format to 1 decimal place
    $averageRating = number_format($sumOfRatings / $totalRatings, 1);

    // Calculate count for each star rating
    foreach ($allReviews as $review) {
        if (isset($ratingCounts[$review->rating])) {
            $ratingCounts[$review->rating]++;
        }
    }
}

// Prepare the data structure for the rating bars
$ratingBarData = [];
foreach (range(5, 1) as $star) {
    $ratingBarData[] = [
        'number' => $star,
        'count' => $ratingCounts[$star],
    ];
}

@endphp


@section('content')
<section class="max-w-6xl mx-auto px-4 py-16">
    <div class="flex flex-col md:flex-row mb-12 items-center">
        {{-- Rating Summary --}}
        <div class="w-[100%] md:w-[50%] flex flex-col items-center" data-aos="fade-right">
            <h2 class="flex justify-center items-center text-5xl font-bold mb-2">
                {{-- Use the calculated average rating --}}
                {{ $averageRating }} 
                <span class="w-10 ml-4">{!! $starSvg !!}</span>
            </h2>
            {{-- Use the calculated total ratings count --}}
            <p class="text-gray-500 mb-6">{{ $totalRatings }} Ratings</p>

            {{-- Rating Bars --}}
            <div class="max-w-lg w-[100%] space-y-2 text-end">
                {{-- Loop through the dynamically calculated $ratingBarData --}}
                @foreach ($ratingBarData as $index => $rating)
                    <div class="flex items-center gap-4" data-aos="fade-up" data-aos-delay="{{ 100 * $index }}">
                        <span class="w-10 flex items-center justify-start text-sm text-gray-600">
                            <span class="w-4 text-start">{{ $rating['number'] }}</span>
                            {!! $starSvgSm !!}
                        </span>

                        <div class="flex-1 bg-gray-200 rounded-full h-2.5">
                            <div class="bg-blue-500 h-2.5 rounded-full"
                                {{-- Calculate percentage based on $totalRatings --}}
                                style="width: {{ $totalRatings > 0 ? ($rating['count'] / $totalRatings) * 100 : 0 }}%">
                            </div>
                        </div>

                        <span class="text-sm text-gray-600 w-10 text-right">
                            ({{ $rating['count'] }})
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Rate Product --}}
        <div class="flex flex-col justify-center items-center text-center ml-8 w-[60%]" data-aos="fade-left">
            <h3 class="text-5xl font-semibold mt-10 md:mt-0 mb-2">Rate Product</h3>
            <p class="text-gray-500 mb-4">Tell others what you think.</p>
            {{-- ⭐ Interactive Stars + Modal --}}
            <div x-data="{{ Auth::check() ? 'ratingModal()' : '{}' }}" class="w-full">
                {{-- Clickable Stars (outside modal) --}}
                <div class="flex justify-center mb-6 gap-x-4">
                    <template x-for="i in 5" :key="i">
                        <button
                            @mouseenter="{{ Auth::check() ? 'hover = i' : '' }}"
                            @mouseleave="{{ Auth::check() ? 'hover = selected' : '' }}"
                            @click="{{ Auth::check() ? 'openModal(i)' : 'popup("Please login or sign up first", "error")' }}"
                            class="focus:outline-none"
                        >
                            <svg class="w-12 h-12 transition-colors"
                                :class="{{ Auth::check() ? '(hover >= i) ? \'text-green-600\' : \'text-gray-300\'' : '\'text-gray-300\'' }}"

                                fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c-.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </button>
                    </template>
                </div>

                {{-- Write Review Button --}}
                <div class="flex justify-center" data-aos="zoom-in" data-aos-delay="400">
                    <x-button variant="gradient" padding="lg" class="w-fit px-8" @click="{{ Auth::check() ? 'openModal(selected || 0)' : 'popup(\'Please login or sign up first\', \'error\')' }}">
                        Write A Review
                    </x-button>
                </div>
				
				{{-- Modal --}}
				@auth
				<style>
					[data-aos] {
						transform: none !important;
					}
				</style>
				<div
					x-show="showModal"
					x-transition
					class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 p-4"
				>
					<div 
						@click.away="closeModal"
						class="bg-white rounded-2xl w-full max-w-md p-6 shadow-xl relative mx-auto"
					>

						{{-- Close button --}}
						<button @click="closeModal"
								class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
							<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
							</svg>
						</button>

						{{-- Header --}}
						<div class="flex items-center gap-3 mb-6">
							<img src="{{ asset('images/ImmaOnStudio Logo.png') }}" alt="Logo" class="w-12 h-12 rounded-lg object-cover shadow-md">
							<div class="flex flex-col flex-start">
								<p class="font-semibold text-gray-800 text-lg">ImmaOnStudio</p>
								<p class="text-gray-500 text-sm text-start">Rate this app</p>
							</div>
						</div>

						{{-- User info --}}
						<div class="flex items-center gap-3 mb-4">
							<img src="{{asset('images/profiles/' . Auth::user()->profile_picture) . '.jpg'}}" alt="{{ Auth::user()->username }}" class="w-10 h-10 rounded-full object-cover">
							<p class="font-medium text-gray-800">{{ Auth::user()->username }}</p>
						</div>

						{{-- Stars --}}
						<div class="flex gap-2 mb-4 justify-center">
							<template x-for="i in 5" :key="i">
								<svg 
									@click="selected = i"
									@mouseenter="hover = i"
									@mouseleave="hover = selected"
									:class="(hover >= i) ? 'text-green-600' : 'text-gray-300'"
									class="w-12 h-12 cursor-pointer transition-colors"
									fill="currentColor"
									viewBox="0 0 20 20"
								>
									<path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c-.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
								</svg>
							</template>
						</div>

						{{-- Review text area --}}
						<div class="relative w-full">
							<textarea
								class="w-full border-gray-300 rounded-lg px-3 py-2 mb-1 text-sm"
								rows="4"
								x-model="review"
								@input="if (review.length > 200) review = review.substring(0, 200)"
								maxlength="200"
								placeholder="Describe your experience…"
							></textarea>

							<span class="absolute bottom-0 right-0 text-xs text-gray-400 pr-1 pb-1">
								<span x-text="review.length"></span>/200
							</span>
						</div>

						<p class="text-gray-500 text-xs mb-4">
							Reviews are public and include your account. Everyone can see your account name and photo, and the content of your review.	
						</p>

						{{-- Buttons --}}
						<div class="flex justify-end gap-2">
							<x-button class="w-[100%]" variant="primary" padding="md" @click="submitReview">Submit</x-button>
						</div>
					</div>
				</div>
				@endauth
			</div>
		</div>
	</div>

	{{-- Reviews List --}}
    <div class="space-y-6">
        @forelse ($reviews as $index => $review)
            <div class="border border-gray-200 rounded-2xl p-6 shadow-sm" data-aos="fade-up" data-aos-delay="{{ 100 * $index }}">
                
                {{-- User Info --}}
                <div class="flex justify-between items-start mb-3">
                    <div class="flex items-center gap-3">

                        {{-- Profile Picture --}}
                        <img src="{{ $review->user->profile_picture 
                            ? asset('images/profiles/' . $review->user->profile_picture . '.jpg') 
                            : asset('images/default_profile_picture.webp') }}"
                            class="w-10 h-10 rounded-full object-cover" alt="avatar">

                        {{-- Name --}}
                        <div>
                            <p class="font-semibold text-gray-800">{{ $review->user->username }}</p>
                            <p class="text-sm text-gray-500">Member</p>
                        </div>
                    </div>

                    {{-- Date --}}
                    <p class="text-sm text-gray-400">
                        {{ $review->created_at->format('d M Y') }}
                    </p>
                </div>

                {{-- Star Rating --}}
                <div class="flex items-center mb-2">
                    <div class="flex items-center text-blue-600">
                        <span class="flex gap-x-2 items-center text-sm font-semibold bg-blue-100 px-2 py-0.5 rounded-md">
                            {{ $review->rating }}
                            {!! $starSvgSm !!}
                        </span>
                    </div>
                </div>

                {{-- Review Content --}}
                <p class="text-gray-600 text-sm leading-relaxed">
                    {{ $review->review ?? '—' }}
                </p>

            </div>
        @empty
            <p class="text-center text-gray-500" data-aos="fade-up">No reviews yet. Be the first to review!</p>
        @endforelse

        <div x-data="{ allReviewsOpen: false }">
            <div class="text-center mt-6" data-aos="fade-up">
                <button 
                    @click="allReviewsOpen = true" 
                    class="text-blue-600 hover:underline text-sm font-medium"
                >
                    See All Reviews
                </button>
            </div>

			<!-- Overlay -->
			<div 
				x-show="allReviewsOpen"
				x-transition.opacity
				class="fixed inset-0 bg-black/40 z-40"
				@click="allReviewsOpen = false"
			></div>

			<!-- Modal -->
			<div 
				x-show="allReviewsOpen"
				x-transition
				@keydown.escape.window="allReviewsOpen = false"
				class="fixed inset-0 z-50 flex items-center justify-center p-4"
			>
				<div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl max-h-[75vh] overflow-hidden flex flex-col" @click.away="allReviewsOpen = false">

					<!-- Header -->
					<div class="flex justify-between items-center p-4 border-b relative">

						<div class="flex items-center gap-3">
							<img src="{{ asset('images/ImmaOnStudio Logo.png') }}" alt="Logo" 
								class="w-12 h-12 rounded-lg object-cover shadow-md">

							<div class="flex flex-col">
								<p class="font-semibold text-gray-800 text-lg">ImmaOnStudio</p>
								<p class="text-gray-500 text-sm">All Reviews</p>
							</div>
						</div>

						<!-- Close button -->
						<button 
							@click="allReviewsOpen = false"
							class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition"
						>
							<svg xmlns="http://www.w3.org/2000/svg" 
								class="w-6 h-6" 
								fill="none" 
								viewBox="0 0 24 24" 
								stroke="currentColor">
								<path stroke-linecap="round" 
									stroke-linejoin="round" 
									stroke-width="2" 
									d="M6 18L18 6M6 6l12 12"/>
							</svg>
						</button>
					</div>

					<!-- Content -->
					<div class="overflow-y-auto p-4 space-y-6">

						@foreach ($allReviews as $review)
							<div class="border border-gray-200 rounded-2xl p-6 shadow-sm">

								{{-- User Info --}}
								<div class="flex justify-between items-start mb-3">
									<div class="flex items-center gap-3">

										{{-- Profile Picture --}}
										<img src="{{ $review->user->profile_picture 
											? asset('images/profiles/' . $review->user->profile_picture . '.jpg') 
											: asset('images/default_profile_picture.webp') }}"
											class="w-10 h-10 rounded-full object-cover" alt="avatar">

										{{-- Name --}}
										<div>
											<p class="font-semibold text-gray-800">{{ $review->user->username }}</p>
											<p class="text-sm text-gray-500">Member</p>
										</div>
									</div>

									{{-- Date --}}
									<p class="text-sm text-gray-400">
										{{ $review->created_at->format('d M Y') }}
									</p>
								</div>

								{{-- Star Rating --}}
								<div class="flex items-center mb-2">
									<div class="flex items-center text-blue-600">
										<span class="flex gap-x-2 items-center text-sm font-semibold bg-blue-100 px-2 py-0.5 rounded-md">
											{{ $review->rating }}
											{!! $starSvgSm !!}
										</span>
									</div>
								</div>

								{{-- Review Content --}}
								<p class="text-gray-600 text-sm leading-relaxed">
									{{ $review->review ?? '—' }}
								</p>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

<script>
function ratingModal() {
    return {
        hover: 0,
        selected: 0,
        showModal: false,
        review: "",

        openModal(i) {
            this.selected = i;
            this.hover = i;
            this.showModal = true;
        },

        closeModal() {
            this.showModal = false;
        },

        submitReview() {
			if (this.selected === 0) {
				popup("Please select a star rating before submitting.", "error");
				return;
			}

			fetch("{{ route('reviews.store') }}", {
				method: "POST",
				headers: {
					"Content-Type": "application/json",
					"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
				},
				body: JSON.stringify({
					rating: this.selected,
					review: this.review
				})
			})
			.then(res => res.json())
			.then(data => {
				if (data.success) {
					popup("Review submitted successfully!", "success");
					this.closeModal();
					window.location.reload(); // reload to show updated list
				} else {
					popup("Something went wrong.", "error");
				}
			})
			.catch(() => {
				popup("Server error. Try again later.", "error");
			});
		}
    }
}
</script>