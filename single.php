<?php
/**
 * The template for displaying all single posts
 *
 * @package Business_Hubs_Theme
 */

get_header(); ?>

<main class="bg-white pt-[60px] lg:pt-[80px]">

  <?php
  while (have_posts()):
    the_post();
    ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      <!-- Hero / Header Section -->
      <header class="relative w-full bg-secondary/5 pb-12 pt-12 lg:pt-20 lg:pb-16">
        <div class="container mx-auto px-[25px]">
          <div class="max-w-4xl mx-auto text-center">

            <!-- Meta Data -->
            <div
              class="flex items-center justify-center gap-4 text-sm lg:text-base font-bold text-accent uppercase tracking-wider mb-4">
              <span><?php echo get_the_date(); ?></span>
              <span class="w-1 h-1 bg-dark rounded-full"></span>
              <span><?php the_author(); ?></span>
            </div>

            <!-- Title -->
            <h1 class="text-3xl lg:text-5xl xl:text-6xl font-extrabold text-secondary leading-tight mb-8">
              <?php the_title(); ?>
            </h1>

            <!-- Featured Image -->
            <?php if (has_post_thumbnail()): ?>
              <div class="relative w-full h-[300px] lg:h-[500px] rounded-2xl overflow-hidden shadow-2xl mt-8">
                <?php the_post_thumbnail('full', array('class' => 'absolute inset-0 w-full h-full object-cover')); ?>
              </div>
            <?php endif; ?>

          </div>
        </div>
      </header>

      <!-- Content Section -->
      <div class="container mx-auto px-[25px] py-12 lg:py-20">
        <div class="max-w-3xl mx-auto">

          <!-- Main Content with Typography Plugin -->
          <div
            class="prose prose-lg prose-headings:font-extrabold prose-headings:text-secondary prose-p:text-dark prose-a:text-accent prose-a:no-underline hover:prose-a:underline max-w-none">
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
            <div class="flex flex-col md:flex-row justify-between gap-8">
              <div class="w-full md:w-1/2">
                <?php
                $prev_post = get_previous_post();
                if ($prev_post):
                  ?>
                  <a href="<?php echo get_permalink($prev_post->ID); ?>"
                    class="group block p-6 border border-gray-200 rounded-xl hover:border-accent transition-colors">
                    <span class="text-sm font-bold text-gray-500 uppercase mb-2 block group-hover:text-accent">Previous
                      Post</span>
                    <h4 class="text-lg font-bold text-secondary group-hover:text-accent transition-colors">
                      <?php echo get_the_title($prev_post->ID); ?></h4>
                  </a>
                <?php endif; ?>
              </div>

              <div class="w-full md:w-1/2 text-right">
                <?php
                $next_post = get_next_post();
                if ($next_post):
                  ?>
                  <a href="<?php echo get_permalink($next_post->ID); ?>"
                    class="group block p-6 border border-gray-200 rounded-xl hover:border-accent transition-colors">
                    <span class="text-sm font-bold text-gray-500 uppercase mb-2 block group-hover:text-accent">Next
                      Post</span>
                    <h4 class="text-lg font-bold text-secondary group-hover:text-accent transition-colors">
                      <?php echo get_the_title($next_post->ID); ?></h4>
                  </a>
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