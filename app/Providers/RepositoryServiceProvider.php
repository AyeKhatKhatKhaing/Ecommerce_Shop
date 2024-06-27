<?php

namespace App\Providers;

use App\Interfaces\Repositories\AboutRemflyRepositoryInterface;
use App\Interfaces\Repositories\BlogCategoryRepositoryInterface;
use App\Interfaces\Repositories\BlogRepositoryInterface;
use App\Interfaces\Repositories\BusinessTypeRepositoryInterface;
use App\Interfaces\Repositories\ClassificationRepositoryInterface;
use App\Interfaces\Repositories\CommonProblemRepositoryInterface;
use App\Interfaces\Repositories\ContactPageRepositoryInterface;
use App\Interfaces\Repositories\CountryRepositoryInterface;
use App\Interfaces\Repositories\CouponRepositoryInterface;
use App\Interfaces\Repositories\ExclusiveOfferRepositoryInterface;
use App\Interfaces\Repositories\FooterRepositoryInterface;
use App\Interfaces\Repositories\HomeRepositoryInterface;
use App\Interfaces\Repositories\MemberCountryRepositoryInterface;
use App\Interfaces\Repositories\MemberExclusiveOfferRepositoryInterface;
use App\Interfaces\Repositories\MemberRepositoryInterface;
use App\Interfaces\Repositories\MemberTypeRepositoryInterface;
use App\Interfaces\Repositories\OfferPromotionRepositoryInterface;
use App\Interfaces\Repositories\PageRepositoryInterface;
use App\Interfaces\Repositories\PrivacyPolicyRepositoryInterface;
use App\Interfaces\Repositories\ProductCategoryRepositoryInterface;
use App\Interfaces\Repositories\ProductLabelRepositoryInterface;
use App\Interfaces\Repositories\PromotionRepositoryInterface;
use App\Interfaces\Repositories\RegionRepositoryInterface;
use App\Interfaces\Repositories\SliderRepositoryInterface;
use App\Interfaces\Repositories\StoreDistributionRepositoryInterface;
use App\Interfaces\Repositories\StoreRepositoryInterface;
use App\Interfaces\Repositories\TermConditionRepositoryInterface;
use App\Repositories\AboutRemflyRepository;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogRepository;
use App\Repositories\BusinessTypeRepository;
use App\Repositories\ClassificationRepository;
use App\Repositories\CommonProblemRepository;
use App\Repositories\ContactPageRepository;
use App\Repositories\CountryRepository;
use App\Repositories\CouponRepository;
use App\Repositories\ExclusiveOfferRepository;
use App\Repositories\FooterRepository;
use App\Repositories\HomeRepository;
use App\Repositories\MemberCountryRepository;
use App\Repositories\MemberExclusiveOfferRepository;
use App\Repositories\MemberRepository;
use App\Repositories\MemberTypeRepository;
use App\Repositories\OfferPromotionRepository;
use App\Repositories\PageRepository;
use App\Repositories\PrivacyPolicyRepository;
use App\Repositories\ProductCategoryRepository;
use App\Repositories\ProductLabelRepository;
use App\Repositories\PromotionRepository;
use App\Repositories\RegionRepository;
use App\Repositories\SliderRepository;
use App\Repositories\StoreDistributionRepository;
use App\Repositories\StoreRepository;
use App\Repositories\TermConditionRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AboutRemflyRepositoryInterface::class, AboutRemflyRepository::class);
        $this->app->bind(BlogRepositoryInterface::class, BlogRepository::class);
        $this->app->bind(BlogCategoryRepositoryInterface::class, BlogCategoryRepository::class);
        $this->app->bind(BusinessTypeRepositoryInterface::class, BusinessTypeRepository::class);
        $this->app->bind(ClassificationRepositoryInterface::class, ClassificationRepository::class);
        $this->app->bind(CommonProblemRepositoryInterface::class, CommonProblemRepository::class);
        $this->app->bind(ContactPageRepositoryInterface::class, ContactPageRepository::class);
        $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);
        $this->app->bind(CouponRepositoryInterface::class, CouponRepository::class);
        $this->app->bind(ExclusiveOfferRepositoryInterface::class, ExclusiveOfferRepository::class);
        $this->app->bind(FooterRepositoryInterface::class, FooterRepository::class);
        $this->app->bind(HomeRepositoryInterface::class, HomeRepository::class);
        $this->app->bind(MemberCountryRepositoryInterface::class, MemberCountryRepository::class);
        $this->app->bind(MemberExclusiveOfferRepositoryInterface::class, MemberExclusiveOfferRepository::class);
        $this->app->bind(MemberRepositoryInterface::class, MemberRepository::class);
        $this->app->bind(MemberTypeRepositoryInterface::class, MemberTypeRepository::class);
        $this->app->bind(OfferPromotionRepositoryInterface::class, OfferPromotionRepository::class);
        $this->app->bind(PageRepositoryInterface::class, PageRepository::class);
        $this->app->bind(ProductCategoryRepositoryInterface::class, ProductCategoryRepository::class);
        $this->app->bind(ProductLabelRepositoryInterface::class, ProductLabelRepository::class);
        $this->app->bind(PrivacyPolicyRepositoryInterface::class, PrivacyPolicyRepository::class);
        $this->app->bind(PromotionRepositoryInterface::class, PromotionRepository::class);
        $this->app->bind(RegionRepositoryInterface::class, RegionRepository::class);
        $this->app->bind(SliderRepositoryInterface::class, SliderRepository::class);
        $this->app->bind(StoreRepositoryInterface::class, StoreRepository::class);
        $this->app->bind(StoreDistributionRepositoryInterface::class, StoreDistributionRepository::class);
        $this->app->bind(TermConditionRepositoryInterface::class, TermConditionRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
