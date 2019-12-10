FROM php:7.3-fpm

LABEL maintainer="MilesChou <github.com/MilesChou>, fizzka <github.com/fizzka>"

ARG PHALCON_VERSION=3.4.2
ARG PHALCON_DEVTOOLS_VERSION=3.4.2
ARG PHALCON_EXT_PATH=php7/64bits

# cphalcon
RUN set -xe && \
        # Compile Phalcon
        curl -LO https://github.com/phalcon/cphalcon/archive/v${PHALCON_VERSION}.tar.gz && \
        tar xzf ${PWD}/v${PHALCON_VERSION}.tar.gz && \
        docker-php-ext-install -j $(getconf _NPROCESSORS_ONLN) ${PWD}/cphalcon-${PHALCON_VERSION}/build/${PHALCON_EXT_PATH} && \
        # Remove all temp files
        rm -r \
            ${PWD}/v${PHALCON_VERSION}.tar.gz \
            ${PWD}/cphalcon-${PHALCON_VERSION}

# devtools
RUN curl -LO https://github.com/phalcon/phalcon-devtools/archive/v${PHALCON_DEVTOOLS_VERSION}.tar.gz \
    && tar xzf v${PHALCON_DEVTOOLS_VERSION}.tar.gz \
    && mv phalcon-devtools-${PHALCON_DEVTOOLS_VERSION} /usr/local/phalcon-devtools \
    && ln -s /usr/local/phalcon-devtools/phalcon /usr/local/bin/phalcon \
    && chmod ugo+x /usr/local/bin/phalcon \
    && rm -f v${PHALCON_DEVTOOLS_VERSION}.tar.gz
