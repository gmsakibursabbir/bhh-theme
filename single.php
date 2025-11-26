<?php
/**
 * The template for displaying all single posts
 *
 * @package Business_Hubs_Theme
 */

get_header(); ?>

<main class="bg-white">

  <?php
  while (have_posts()):
    the_post();
    ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <!-- hero -->
      <section class="ty-gradient h-[260px] lg:h-[500px]  -mt-[60px] lg:-mt-[80px] z-10">
        <div class="max-w-[1444px] mx-auto px-[25px] lg:px-0 w-full h-full flex flex-col items-center justify-center">
          <div class="">
            <h1
              class="text-3xl lg:text-5xl xl:text-6xl font-extrabold text-white mx-auto text-center leading-tight pt-[40px] lg:pt-[56px] ">
              <?php the_title(); ?>
            </h1>
            <!-- Meta Data -->
            <div
              class="flex items-center justify-center gap-4 text-sm lg:text-base font-bold text-white uppercase tracking-wider mt-4">
              <span><?php echo get_the_date(); ?></span>
              <span class="w-1 h-1 bg-white rounded-full"></span>
              <span><?php the_author(); ?></span>
            </div>
          </div>
        </div>
      </section>
      <!-- Content Section -->
      <div class="max-w-[1024px] mx-auto px-[25px] py-12 lg:py-20">
        <div class="mx-auto">
          <!-- Featured Image -->
          <?php if (has_post_thumbnail()): ?>
            <div class="relative w-full h-[400px] lg:h-[600px] rounded-2xl overflow-hidden shadow-md">
              <?php the_post_thumbnail('full', array('class' => 'absolute inset-0 w-full h-full object-cover')); ?>
            </div>
          <?php endif; ?>
          <!-- Main Content with Typography Plugin -->
          <div
            class="prose prose-lg prose-headings:font-extrabold prose-headings:text-secondary prose-p:text-dark prose-a:text-accent prose-a:no-underline hover:prose-a:underline max-w-none mt-14">
            <?php the_content(); ?>
          </div>

          <!-- Post Footer / Navigation -->
          <footer class="mt-16 pt-8 border-t border-gray-200">

            <!-- Tags -->
            <?php
            $tags_list = get_the_tag_list('', ' ');
            if ($tags_list) {
              printf('<div class="mb-8"><span class="font-bold text-dark mr-2">Tags:</span>%s</div>', $tags_list);
            }
            ?>

            <!-- Next/Prev Navigation -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <!-- Previous Post -->
              <div class="w-full">
                <?php
                $prev_post = get_previous_post();
                if ($prev_post):
                  ?>
                  <a href="<?php echo get_permalink($prev_post->ID); ?>"
                    class="group relative block overflow-hidden rounded-2xl bg-gradient-to-br from-green/5 to-secondary/10 border-2 border-green/20 hover:border-primary transition-all duration-500 hover:shadow-2xl hover:shadow-green/20 hover:-translate-y-1">
                    <div class="p-4 lg:p-5">
                      <!-- Direction Icon and Label -->
                      <div class="flex items-center gap-2 mb-3">
                        <div
                          class="w-8 h-8 rounded-full bg-gradient-to-br from-primary to-secondary flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                          <svg
                            class="w-4 h-4 text-white transform group-hover:-translate-x-1 transition-transform duration-500"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                          </svg>
                        </div>
                        <span class="text-xs font-extrabold text-primary uppercase tracking-widest">Previous Article</span>
                      </div>

                      <!-- Post Title -->
                      <h4
                        class="text-lg lg:text-xl font-extrabold text-dark leading-tight group-hover:text-primary transition-colors duration-300 line-clamp-2">
                        <?php echo get_the_title($prev_post->ID); ?>
                      </h4>
                    </div>

                    <!-- Animated Gradient Overlay -->
                    <div
                      class="absolute inset-0 bg-gradient-to-br from-primary/0 to-secondary/0 group-hover:from-primary/5 group-hover:to-secondary/10 transition-all duration-500 pointer-events-none">
                    </div>
                  </a>
                <?php else: ?>
                  <div class="opacity-40 pointer-events-none">
                    <div class="block rounded-2xl bg-gray-100 border-2 border-gray-200">
                      <div class="p-4 lg:p-5">
                        <div class="flex items-center gap-2 mb-3">
                          <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                            </svg>
                          </div>
                          <span class="text-xs font-extrabold text-gray-500 uppercase tracking-widest">Previous
                            Article</span>
                        </div>
                        <h4 class="text-lg lg:text-xl font-extrabold text-gray-400 leading-tight">
                          No Previous Post
                        </h4>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>
              </div>

              <!-- Next Post -->
              <div class="w-full">
                <?php
                $next_post = get_next_post();
                if ($next_post):
                  ?>
                  <a href="<?php echo get_permalink($next_post->ID); ?>"
                    class="group relative block overflow-hidden rounded-2xl bg-gradient-to-br from-secondary/10 to-accent/10 border-2 border-secondary/20 hover:border-primary transition-all duration-500 hover:shadow-2xl hover:shadow-accent/20 hover:-translate-y-1">
                    <div class="p-4 lg:p-5">
                      <!-- Direction Icon and Label -->
                      <div class="flex items-center justify-end gap-2 mb-3">
                        <span class="text-xs font-extrabold text-primary uppercase tracking-widest">Next Article</span>
                        <div
                          class="w-8 h-8 rounded-full bg-gradient-to-br from-secondary to-accent flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                          <svg
                            class="w-4 h-4 text-white transform group-hover:translate-x-1 transition-transform duration-500"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                          </svg>
                        </div>
                      </div>

                      <!-- Post Title -->
                      <h4
                        class="text-lg lg:text-xl font-extrabold text-dark leading-tight group-hover:text-primary transition-colors duration-300 text-right line-clamp-2">
                        <?php echo get_the_title($next_post->ID); ?>
                      </h4>
                    </div>

                    <!-- Animated Gradient Overlay -->
                    <div
                      class="absolute inset-0 bg-gradient-to-br from-secondary/0 to-accent/0 group-hover:from-secondary/5 group-hover:to-accent/10 transition-all duration-500 pointer-events-none">
                    </div>
                  </a>
                <?php else: ?>
                  <div class="opacity-40 pointer-events-none">
                    <div class="block rounded-2xl bg-gray-100 border-2 border-gray-200">
                      <div class="p-4 lg:p-5">
                        <div class="flex items-center justify-end gap-2 mb-3">
                          <span class="text-xs font-extrabold text-gray-500 uppercase tracking-widest">Next Article</span>
                          <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                            </svg>
                          </div>
                        </div>
                        <h4 class="text-lg lg:text-xl font-extrabold text-gray-400 leading-tight text-right">
                          No Next Post
                        </h4>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>
              </div>
            </div>

          </footer>

        </div>
      </div>

    </article>

    <?php
  endwhile; // End of the loop.
  ?>

</main>

<?php
get_footer();