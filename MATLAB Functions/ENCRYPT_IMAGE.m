function [ENCR] = ENCRYPT_IMAGE( A, seed )
%UNTITLED7 Summary of this function goes here
%   Detailed explanation goes here
[M,N]=size(A);
N=N/3;
B=reshape(double(A),[M*N*3,1]);
s = RandStream('mt19937ar','Seed',seed);
KEY=randperm(s,M*N*3+2);
C=[M N B'];
C=C(KEY);
ENCR=reshape(C,[M*N*3+2,1]);
end

